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

    public function getAll(array $condition = [], $limit = 10)
    {
        $selectList = $this->_model;

        if ($searchName = array_get($condition, 'name'))
        {

            $selectList = $selectList->where('ca_name','LIKE', '%'.$searchName.'%');
        }

        if ($orderById=array_get($condition,'orderById')){
            $selectList=$selectList->orderBy('id',$orderById);
        }

        if ($option=array_get($condition,'searchOption')){
            switch ($option){
                case 'new':
                    $selectList=$selectList->where('id',5);
                    break;
                case 'top':

                    break;

            }
        }

        $result = $selectList->paginate($limit);

        return $result;
    }

    public function create(array $attributes)
    {
        $arr=[
            'ca_name'=>strip_tags($attributes['ca_name']),
            'ca_slug'=>$this->to_slug(strip_tags($attributes['ca_name']))
        ];
        return parent::create($arr);
    }

    public function updateAjax(array $attributes)
    {
        $id=$attributes['id'];
        $arr=[
            'ca_name'=>strip_tags($attributes['ca_name']),
            'ca_slug'=>str_slug(strip_tags($attributes['ca_name']))
        ];

        return parent::update($id, $arr);
    }


}