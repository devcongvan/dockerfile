<?php

namespace App\Model;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use ElasticquentTrait;

    protected $table="items";

    public $fillable=['title','description'];

    public function getIndexName()
    {
        return 'candidates';
    }
}
