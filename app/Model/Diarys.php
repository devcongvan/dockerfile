<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Diarys extends Model
{
    protected $table='diarys';

    protected $fillable=[
        'd_cantype_id',
        'd_can_id',
        'd_evaluate',
        'd_set_calendar',
        'd_notice_before',
        'd_note'
    ];
}
