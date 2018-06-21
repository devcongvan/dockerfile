<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/20/2018
 * Time: 8:32 PM
 */

namespace App\Repositories\Career;

use App\Model\Career;
use App\Repositories\EloquentRepository;

class CareerEloquentRepository extends EloquentRepository
{
    public function setModel()
    {
        return Career::class;
    }

    public function create(array $attributes)
    {
        $arr=[
            'ca_name'=>$attributes['ca_name'],
            'ca_slug'=>$this->to_slug($attributes['ca_name'])
        ];
        return parent::create($arr);
    }

    public function updateAjax(array $attributes)
    {
        $id=$attributes['id'];
        $arr=[
            'ca_name'=>$attributes['ca_name'],
            'ca_slug'=>str_slug($attributes['ca_name'])
        ];

        return parent::update($id, $arr);
    }


}