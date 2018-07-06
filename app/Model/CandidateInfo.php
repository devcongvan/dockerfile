<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateInfo extends Model
{
    protected $table='candidates_infos';

    protected $fillable=[
        'ci_candidates_id',
        'ci_work_abroad',
        'ci_time_experience',
        'ci_qualification',
        'ci_english_level',
        'ci_type_of_work',
        'ci_salary',
        'ci_target',
        'ci_about',
        'ci_work_experience',
        'ci_education',
        'ci_activity',
        'ci_certificate',
        'ci_prize',
        'ci_skill',
        'ci_hobby'
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class,'ci_candidates_id');
    }
}
