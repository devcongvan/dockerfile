<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table='locations';

    public function workplace()
    {
        return $this->hasMany(Workplace::class, 'wp_locations_id');
    }

}
