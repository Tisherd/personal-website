<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRole extends Model
{
    public $timestamps = true;

    protected $table = 'user_roles';

    protected $fillable = ['title'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
