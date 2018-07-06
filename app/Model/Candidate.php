<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'can_name',
        'can_birthday',
        'can_gender',
        'can_avatar',
        'can_phone',
        'can_email',
        'hometown',
        'can_address',
        'can_skype',
        'can_facebook',
        'can_linkedin',
        'can_github',
        'can_source_id',
        'can_title',
        'can_year'
    ];

    public function candidateInfo()
    {
        return $this->hasOne(CandidateInfo::class, 'ci_candidates_id');
    }

    public function location()
    {
        return $this->belongsToMany(Location::class, 'workplaces', 'wp_candidates_id', 'wp_locations_id');
    }

    public function candidateCareer()
    {
        return $this->hasMany(CandidateCareer::class, 'cc_candidates_id');
    }

    public function career()
    {
        return $this->belongsToMany(Career::class, 'candidates_careers', 'cc_candidates_id', 'cc_careers_id');
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'candidates_skills', 'cs_candidates_id', 'cs_skills_id');
    }
    
    public function source(){
        return $this->belongsTo(Source::class,'can_source_id','id');
    }

}
