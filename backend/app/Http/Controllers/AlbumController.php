<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
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
     * Store a new album for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image upload
                'date' => 'required|date',
                'featured' => 'required',
            ]);

            // Get the authenticated user
            $user = Auth::user();

            // Store the uploaded image and get its path
            $imagePath = $request->file('img')->store('albums', 'public');

            // Create a new album for the user
            $album = $user->albums()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'img' => $imagePath,
                'date' => $request->input('date'),
                'featured' => (bool) $request->input('featured'),
            ]);

            // Return a success response with the created album
            return $this->sendSuccess(['album' => $album], 'Album created successfully', 201);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
