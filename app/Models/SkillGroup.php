<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillGroup extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'sort'];

    public function skills()
    {
        return $this->hasMany(Skill::class, 'skill_group_id');
    }
}
