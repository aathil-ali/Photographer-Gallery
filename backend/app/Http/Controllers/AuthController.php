<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Database\Seeders\AlbumSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Log;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply the 'auth:api' middleware to all methods except 'login' and 'register'
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {


            // Validate user registration input
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'phone_number' => 'required|string|max:20',
                'bio' => 'nullable|string',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for profile picture

            ]);

            $findUser = User::where('email', $request->input('email'))->first();

            if ($findUser)  return $this->sendError('User email already registered', 200);

            // Create a new user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            // Create a profile for the user
            // Handle profile picture upload
            if ($request->hasFile('picture')) {
                $profilePicture = $request->file('picture');
                $path = $profilePicture->store('profile_pictures', 'public'); // Save the profile picture to the storage
                $user->profile()->create([
                    'phone_number' => $request->input('phone_number'),
                    'bio' => $request->input('bio'),
                    'profile_picture' => $path, // Save the file path to the profile
                ]);
            } else {
                // Create a profile for the user without profile picture
                $user->profile()->create([
                    'phone_number' => $request->input('phone_number'),
                    'bio' => $request->input('bio'),
                    'profile_picture' => Profile::DEFAULT_PROFILE_PATH
                ]);
            }

            $albumSeeder = new AlbumSeeder($user->id);
            $albumSeeder->run();

            // Return success response
            return $this->sendSuccess(['user' => $user], 'User registered successfully', 201);
        } catch (\Exception $e) {
            // Log any exceptions that occur during registration
            Log::error($e);

            // Return error response
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Authenticate a user and return a token upon successful login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            // Validate user login input
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            // Attempt to authenticate the user and get the token
            $credentials = $request->only('email', 'password');
            $token = Auth::attempt($credentials);

            // Check if authentication is successful
            if ($token) {
                $user = Auth::user();

                // Return success response with user details and token
                return $this->sendSuccess([
                    'user' => $user,
                    'authorization' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ], 'Login successful', 200);
            } else {
                // Invalid credentials, throw validation exception

                return $this->sendError('Invalid credentials', 401);
                throw ValidationException::withMessages(['error' => 'Invalid credentials']);
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur during login
            Log::error($e);

            // Return error response
            return $this->sendError('Login failed', 401);
        }
    }

    /**
     * Logout the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            // Revoke the access token
            Auth::logout();

            return $this->sendSuccess([], 'Logout successful', 200);
        } catch (\Exception $e) {
            // Log any exceptions that occur during logout
            Log::error($e);

            // Return error response
            return $this->sendError('Logout failed', 500);
        }
    }
}
