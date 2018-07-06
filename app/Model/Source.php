<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table='sources';

    protected $fillable=[
        'so_name','so_slug'
    ];
    
    public function candidate(){
        return $this->hasMany(Candidate::class,'can_source_id','id');
    }
}
