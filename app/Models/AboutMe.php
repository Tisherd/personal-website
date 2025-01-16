<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

use Carbon\Carbon;

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

    protected static function booted(): void
    {
        static::updated(function () {
            Cache::forget('about_me_data');
        });
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->photo_path ? asset('storage/' . $this->photo_path) : null,
        );
    }

    protected function birthdateFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->birth_date
                ? Carbon::createFromFormat('Y-m-d', $this->birth_date)
                    ->locale('ru')
                    ->translatedFormat('d F Y г.')
                : null,
        );
    }

    protected function fullAge(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->birth_date
                ? Carbon::createFromFormat('Y-m-d', $this->birth_date)->age
                : null,
        );
    }
}
