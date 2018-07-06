<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table='skills';

    protected $fillable=[
      'sk_name','sk_slug'
    ];

    public function candidateSkill(){
        return $this->hasMany(CandidateSkill::class, 'cs_skills_id');
    }

    public function getNameForSelect(){
        return $this->id.'|'.$this->sk_name;
    }
}
