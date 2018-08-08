<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateTag extends Model
{
    protected $table='candidate_tags';

    public $timestamps=false;

    protected $fillable=[
        'candidate_id','candidate_tag_value','candidate_tag_attribute'
    ];
}
