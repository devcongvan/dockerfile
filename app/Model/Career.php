<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table='careers';

    protected $fillable=[
      'ca_name', 'ca_slug'
    ];

    public function candidateCareer(){
        return $this->hasMany(CandidateCareer::class,'cc_careers_id');
    }

    public function candidates(){
        return $this->morphToMany(Candidate::class, 'candidate_tag');
    }




}
