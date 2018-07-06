<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/22/2018
 * Time: 11:53 PM
 */

namespace App\Repositories\Location;

use App\Repositories\EloquentRepository;
use App\Model\Location;

class LocationEloquentRepository extends EloquentRepository
{

    public function setModel()
    {
        return Location::class;
        // TODO: Implement setModel() method.
    }

    public function getAll(array $condition = [],$paginate=false, $limit = 10)
    {
        $selectList=$this->_model;

        if ($select=array_get($condition, 'select')){
            $selectList=$selectList->select($select);
        }

        if ($where=array_get($condition, 'where')){
            $selectList=$selectList->where($where);
        }

        if ($orderBy=array_get($condition, 'orderby')){
            $selectList=$selectList->orderby($orderBy);
        }

        if ($paginate==true){
            return $selectList->paginate($limit);
        }else{
            return $selectList->get();
        }


    }

    public function updateAjax(array $attributes)
    {
        // TODO: Implement updateAjax() method.
    }

    public function search(array $arr)
    {
        $selectList=$this->_model->select('id','loc_name','loc_parent_id');

        if ($loc_name = array_get($arr, 'loc_name'))
        {
            $selectList = $selectList->where('loc_name', 'like', '%' . $loc_name . '%');
        }

        if ($loc_parent_id=array_get($arr, 'loc_parent_id')){
            $selectList=$selectList->where('loc_parent_id',$loc_parent_id);
        }else{
            $selectList=$selectList->where('loc_level',1);
        }

        return $selectList->get();

    }

}