<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09/07/2018
 * Time: 4:08 PM
 */

namespace App\Repositories\CandidateType;
use App\Model\CandidateType;
use App\Repositories\EloquentRepository;

class CandidateTypeEloquentRepository extends EloquentRepository
{
    public function setModel()
    {
        return CandidateType::class;
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

        if ($paginate==true){
            $selectList=$selectList->paginate($limit);
        }elseif(array_get($condition, 'count')==true){
            $selectList = $selectList->count();
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