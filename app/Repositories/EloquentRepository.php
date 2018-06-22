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
        $this->_model=app()->make($this->setModel());
    }

    abstract public function setModel();

    abstract function getAll(array $condition=[], $limit=10);

    public function getById($id)
    {
        $result=$this->_model->find($id);
        return $result;
    }

    public function create(array $attributes){
        return $this->_model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $aTable=$this->_model->find($id);
        if ($aTable){
            $aTable->update($attributes);
            return $aTable;
        }
        return false;
    }

    public function updateAjax(array $attributes){

    }

    public function delete($id)
    {
        $aTable=$this->_model->find($id);
        if ($aTable){
            $aTable->delete();
            return true;
        }
        return false;
    }

    protected function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }


}