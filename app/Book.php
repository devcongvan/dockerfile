<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Book extends Model
{
    use ElasticquentTrait;
    public function __construct()
    {

    }

    protected $table='books';

    protected $fillable=[
        'bk_name',
        'bk_quantity',
        'bk_price'
    ];

    function getIndexName()
    {
        return 'books';
    }

    function getTypeName()
    {
        return 'books';
    }
}
