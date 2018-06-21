<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table='candidates';

    public function candidateCareer(){
        return $this->hasMany(CandidateCareer::class,'cc_candidates_id');
    }
}
