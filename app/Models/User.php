<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'users';

    protected $fillable = [
        'login',
        'name',
        'password',
        'role_id',
        'desc',
    ];

    protected $hidden = [
        'password',
    ];

    protected $with = ['role'];

    protected $appends = ['is_admin'];

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->role->title === UserRole::ADMIN
        );
    }
}
