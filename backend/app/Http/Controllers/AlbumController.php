<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $user = Auth::user();

            $profile = $user->profile;

            $album = $user->albums;

            return $this->sendSuccess([
                'name' => $user->name,
                'phone' => $profile->phone_number,
                'email' => $user->email,
                'bio' => $profile->bio,
                'profile_picture' => $profile->profile_picture, // Add your logic to retrieve the profile picture path
                'album' => $album,
            ], "success", 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image upload
                'date' => 'required|date',
                'featured' => 'required',
            ]);

            $user = Auth::user();

            $imagePath = $request->file('img')->store('albums', 'public');

            $album = $user->albums()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'img' => $imagePath,
                'date' => $request->input('date'),
                'featured' => (bool) $request->input('featured'),
            ]);

            return $this->sendSuccess(['album' => $album], 'Album created successfully', 201);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

}
