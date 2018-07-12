<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09/07/2018
 * Time: 4:30 PM
 */

namespace App\Repositories\Diary;
use App\Model\Diary;
use App\Repositories\EloquentRepository;

class DiaryEloquentRepository extends EloquentRepository
{
    public function setModel()
    {
        return Diary::class;
        // TODO: Implement setModel() method.
    }

    public function getAll(array $condition = [],$paginate=false, $limit = 10)
    {
        $selectList=$this->_model;

        if ($with=array_get($condition,'with')){
            $selectList=$selectList->with($with);
        }

        if ($select=array_get($condition, 'select')){
            $selectList=$selectList->select($select);
        }

        if ($where=array_get($condition, 'where')){
            $selectList=$selectList->where($where);
        }

        if ($orderby=array_get($condition, 'orderby')){
            $selectList=$selectList->orderBy($orderby['field'],$orderby['type']);
        }

        if ($skip=array_get($condition,'start')){
            $selectList=$selectList->skip($skip);
        }

        if ($take=array_get($condition,'limit')){
            $selectList=$selectList->take($take);
        }

        if ($paginate==true){
            $selectList=$selectList->paginate($limit);
        }elseif(array_get($condition, 'count')==true){
            $selectList = $selectList->count();
        }elseif(array_get($condition,'first')==true){
            $selectList = $selectList->first();
        }elseif($min=array_get($condition,'min')){
            $selectList = $selectList->min($min);
        }elseif ($max=array_get($condition,'max')){
            $selectList = $selectList->max($max);
        }else{
            $selectList = $selectList->get();
        }

        return $selectList;
        // TODO: Implement getAll() method.
    }

    public function updateAjax(array $attributes)
    {
        // TODO: Implement updateAjax() method.
    }
}