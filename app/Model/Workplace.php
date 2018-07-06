<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $table='workplaces';

    protected $fillable=[
        'wp_candidates_id',
        'wp_locations_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'wp_candidates_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'wp_locations_id');
    }

}
