<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Diary extends Model
{
    use ElasticquentTrait;

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

    protected $mappingProperties = [
        'd_cantype_id' => [
            'type' => 'integer',
        ],
        'd_can_id'=>[
            'type'=>'integer'
        ],
        'd_evaluate'=>[
            'type'=>'text',
            'analyzer' => 'standard'
        ],
        'd_set_calendar'=>[
            'type'=>'text'
        ],
        'd_set_time'=>[
            'type'=>'text'
        ],
        'd_notice_before'=>[
            'type'=>'text'
        ],
        'd_note'=>[
            'type'=>'text',
            'analyzer' => 'standard'
        ],
        'd_breaktime'=>[
            'type'=>'text'
        ],
        'created_at'=>[
            'type'=>'date'
        ],
        'updated_at'=>[
            'type'=>'date'
        ]

    ];

    function getIndexName()
    {
        return "diarys";
    }

    function getTypeName()
    {
        return "diarys";
    }



    public function candidateType(){
        return $this->belongsTo(CandidateType::class,'d_cantype_id','id');
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class,'d_can_id','id');
    }
}
