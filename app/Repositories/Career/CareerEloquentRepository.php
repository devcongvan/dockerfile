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

    public function getAll(array $condition = [], $paginate = false, $limit = 10)
    {

        $selectList = $this->_model;

        if ($select=array_get($condition, 'select')){
            $selectList=$selectList->select($select);
        }

        if ($searchName = array_get($condition, 'name'))
        {
            $selectList = $selectList->where('ca_name','LIKE', '%'.$searchName.'%');
        }

        if ($orderById=array_get($condition,'orderById')){
            $selectList=$selectList->orderBy('id',$orderById);
        }

        if ($where=array_get($condition, 'where')){
            $selectList=$selectList->where($where);
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

        if ($paginate==true){
            $result = $selectList->paginate($limit);
        }else{
            $result=$selectList->get();
        }

        return $result;
    }

    public function search($string){
        return $this->_model->select('id','ca_name')->where('ca_name','like','%'.$string.'%')->get();
    }

    public function create(array $attributes)
    {

        $arr=[
            'ca_name'=>strip_tags($attributes['ca_name']),
            'ca_slug'=>$this->to_slug(strip_tags($attributes['ca_name']))
        ];
        $career=parent::create($arr);
        return $career->id;
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