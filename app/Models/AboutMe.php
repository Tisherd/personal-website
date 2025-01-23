<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;

use Carbon\Carbon;
use MongoDB\Laravel\Eloquent\Model;

class AboutMe extends Model
{
    const CACHE_KEY = 'about_me_data';

    const DOC_ID = 'about_me';

    public $timestamps = true;

    protected $connection = 'mongodb';

    protected $table = 'resume';

    protected $fillable = [
        '_id',
        'full_name',
        'birth_date',
        'photo_path',
        'about_me',
        'contacts',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::updated(function () {
            Cache::forget(self::CACHE_KEY);
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
                ? Carbon::parse($this->birth_date)
                ->locale('ru')
                ->translatedFormat('d F Y г.')
                : null,
        );
    }

    protected function fullAge(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->birth_date
                ? Carbon::parse($this->birth_date)->age
                : null,
        );
    }
}
