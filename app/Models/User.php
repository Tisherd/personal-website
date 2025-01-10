<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = true;

    protected $table = 'users';

    protected $fillable = [
        'login',
        'password',
        'role_id',
        'desc',
    ];

    protected $hidden = [
        'password',
    ];

    protected $with = ['role'];

    protected $appends = ['is_admin'];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id')
            ->withDefault(['title' => 'no_role']);
    }

    public function getIsAdminAttribute()
    {
        return $this->role->title === 'admin';
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
