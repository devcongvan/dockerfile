<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateTypes extends Model
{
    protected $table='candidate_types';

    protected $fillable=[
        'canty_name','canty_color'
    ];
}
