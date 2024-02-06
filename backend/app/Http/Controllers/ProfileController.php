<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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

            $albums = $user->albums;

            return $this->sendSuccess([
                'name' => $user->name,
                'phone' => $profile->phone_number,
                'email' => $user->email,
                'bio' => $profile->bio,
                'profile_picture' => $profile->profile_picture, // Add your logic to retrieve the profile picture path
                'albums' => $albums,
            ], "success", 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
