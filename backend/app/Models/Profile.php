<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Constant for the default profile picture path
    const DEFAULT_PROFILE_PATH = "profile_pictures/default.jpg";

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'user_id',
        'phone_number',
        'bio',
        'profile_picture',
    ];

    /**
     * Define a relationship with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
