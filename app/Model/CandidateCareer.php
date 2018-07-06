<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateCareer extends Model
{
    protected $table='candidates_careers';

    protected $fillable=[
        'cc_candidates_id',
        'cc_careers_id'
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class,'cc_candidates_id');
    }

    public function career(){
        return $this->belongsTo(Career::class,'cc_careers_id');
    }
}
