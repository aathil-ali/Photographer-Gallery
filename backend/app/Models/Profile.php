<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    CONST DEFAULT_PROFILE_PATH = "profile_pictures/default.jpg";


    protected $fillable = [
        'user_id', 'phone_number', 'bio', 'profile_picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
