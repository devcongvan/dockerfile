<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/20/2018
 * Time: 8:28 PM
 */

namespace App\Repositories;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $_model;

    public function __construct()
    {
        $this->_model = \App::make($this->setModel());
    }

    abstract public function setModel();

    public function getAll(array $condition = [])
    {
        $table = $this->_model;

        if ($with = array_get($condition, 'with'))
        {
            $table = $table->with($with);
        }

        if ($columns = array_get($condition, 'columns'))
        {
            $table = $table->select($columns);
        }

        if ($wheres = array_get($condition, 'wheres'))
        {
            $table = $table->where($wheres);
        }

        if ($orderby = array_get($condition, 'orderby'))
        {
            $table = $table->orderBy($orderby[0], $orderby[1]);
        }

        if ($skip = array_get($condition, 'skip'))
        {
            $table = $table->skip($skip);
        }

        if ($take = array_get($condition, 'take'))
        {
            $table = $table->take($take);
        }

        if ($paginate = array_get($condition, 'paginate'))
        {
            $table = $table->paginate($paginate);
        }
        else if (array_get($condition, 'count'))
        {
            $table = $table->count();
        }
        else if (array_get($condition, 'first'))
        {
            $table = $table->first();
        }
        else if ($max = array_get($condition, 'max'))
        {
            $table = $table->max($max);
        }
        else if ($min = array_get($condition, 'min'))
        {
            $table = $table->min($min);
        }
        else
        {
            $table = $table->get();
        }

        return $table;
    }

    public function getById($id, $with = '')
    {
        if (!empty($with))
        {
            $result = $this->_model->with($with)->find($id);
        }
        else
        {
            $result = $this->_model->find($id);
        }

        return $result;
    }

    public function getFirst($column = 'id')
    {
        return $this->_model->orderby($column, 'desc')->first();
    }

    public function getLast($column = 'id')
    {
        return $this->_model->orderby($column, 'desc')->first();
    }

    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    public function insert(array $attributes){
        return $this->_model->insert($attributes);
    }

    public function update($id, array $attributes)
    {
        $aTable = $this->_model->find($id);
        if ($aTable)
        {
            $aTable->update($attributes);

            return $aTable;
        }

        return false;
    }

    public function updateMulti(array $arrID, array $arrData)
    {
        if ($this->_model->whereIn('id', $arrID)->update($arrData))
        {
            return true;
        }

        return false;
    }

    public function updateAfield($id, $field, $value)
    {
        $aTable = $this->_model->find($id);
        $aTable->$field = $value;
        $aTable->save();

    }

    public function delete($id)
    {
        $aTable = $this->_model->find($id);
        if ($aTable)
        {
            $aTable->delete();

            return true;
        }

        return false;
    }

    public function deleteByCandidateId($id, $field_name)
    {
        $this->_model->where($field_name, $id)->delete();
    }

}