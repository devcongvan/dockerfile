<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateType extends Model
{
    protected $table='candidate_types';

    protected $fillable=[
        'canty_name','canty_color'
    ];

    public function diary(){
        return $this->hasMany(Diarys::class,'d_cantype_id','id');
    }
}
