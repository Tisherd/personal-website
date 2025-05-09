<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'description', 'level', 'sort', 'skill_group_id'];

    public function group()
    {
        return $this->belongsTo(SkillGroup::class, 'skill_group_id');
    }
}
