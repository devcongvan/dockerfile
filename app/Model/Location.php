<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table='locations';

    protected $fillable=[
        'loc_name','loc_slug'
    ];
    
    public function candidates(){
        return $this->morphToMany(Candidate::class, 'candidate_tag');
    }

}
