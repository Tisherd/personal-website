<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'github_url',
        'live_url',
    ];

    protected $appends = ['img_url'];

    protected function imgUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->project_img
                ? asset('storage/' . $this->project_img)
                : asset('storage/images/projects/project_stub.webp'),
        );
    }
}
