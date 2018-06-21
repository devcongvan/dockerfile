<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/20/2018
 * Time: 7:24 PM
 */

namespace App\Repositories;


interface RepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function create(array $attributes);

    public function update($id,array $attributes);

    public function updateAjax(array $attributes);

    public function delete($id);
}