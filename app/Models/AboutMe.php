<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    public $timestamps = true;

    protected $table = 'about_me';

    protected $fillable = [
        'full_name',
        'birth_date',
        'photo_path',
        'about_me',
        'contacts',
    ];
}
