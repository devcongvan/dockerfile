<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table='careers';

    protected $fillable=[
      'ca_name', 'ca_slug'
    ];
}
