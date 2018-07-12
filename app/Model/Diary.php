<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table='diarys';

    protected $fillable=[
        'd_cantype_id',
        'd_can_id',
        'd_evaluate',
        'd_set_calendar',
        'd_set_time',
        'd_notice_before',
        'd_note',
        'd_breaktime'
    ];

    public function candidateType(){
        return $this->belongsTo(CandidateType::class,'d_cantype_id','id');
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class,'d_can_id','id');
    }
}
