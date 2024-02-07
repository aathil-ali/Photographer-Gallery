<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Constructor to apply middleware for API authentication.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display the authenticated user's profile and albums.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Retrieve user profile and albums
            $profile = $user->profile;
            $albums = $user->albums;

            // Return a success response with user details and albums
            return $this->sendSuccess([
                'name' => $user->name,
                'phone' => $profile->phone_number,
                'email' => $user->email,
                'bio' => $profile->bio,
                'profile_picture' => $profile->profile_picture, // Add your logic to retrieve the profile picture path
                'albums' => $albums,
            ], "success", 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Store a new profile for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $this->validate($request, [
                'phone_number' => 'required|string|max:20',
                'bio' => 'required|string',
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for profile picture upload
            ]);

            // Get the authenticated user
            $user = Auth::user();

            // Check if the user already has a profile
            $existingProfile = $user->profile;

            if ($existingProfile) {
                // Update the existing profile
                $existingProfile->update([
                    'phone_number' => $request->input('phone_number'),
                    'bio' => $request->input('bio'),
                    'profile_picture' => $request->hasFile('profile_picture')
                        ? $request->file('profile_picture')->store('profile_pictures', 'public')
                        : $existingProfile->profile_picture, // Keep the existing profile picture if not updated
                ]);
            } else {
                // Create a new profile for the user
                $profile = $user->profile()->create([
                    'phone_number' => $request->input('phone_number'),
                    'bio' => $request->input('bio'),
                    'profile_picture' => $request->hasFile('profile_picture')
                        ? $request->file('profile_picture')->store('profile_pictures', 'public')
                        : Profile::DEFAULT_PROFILE_PATH, // Use the default profile picture path if not provided
                ]);
            }

            // Return a success response with the updated or created profile
            return $this->sendSuccess(['profile' => $profile ?? $existingProfile], 'Profile updated successfully', 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
