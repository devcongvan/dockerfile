<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    protected $table='candidates_skills';

    protected $fillable=[
        'cs_candidates_id',
        'cs_skills_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'cs_candidates_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'cs_skills_id');
    }
}
