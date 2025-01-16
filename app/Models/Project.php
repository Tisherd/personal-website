<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = true;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'github_url',
        'live_url',
    ];
}
