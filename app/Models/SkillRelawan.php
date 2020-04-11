<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillRelawan extends Model
{
    protected $table = 'skill_relawan';
    
    public function skill()
    {
        return $this->belongsTo('App\Models\Skill', 'id_skill');
    }
}
