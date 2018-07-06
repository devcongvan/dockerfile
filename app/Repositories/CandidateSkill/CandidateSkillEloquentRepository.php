<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/24/2018
 * Time: 4:56 PM
 */

namespace App\Repositories\CandidateSkill;

use App\Model\CandidateSkill;
use App\Repositories\EloquentRepository;

class CandidateSkillEloquentRepository extends EloquentRepository
{
    public function setModel()
    {
        return CandidateSkill::class;
        // TODO: Implement setModel() method.
    }

    public function getAll(array $condition = [],$paginate=false, $limit = 10)
    {
        // TODO: Implement getAll() method.
    }

    public function create(array $attributes)
    {
        $this->_model->insert($attributes);
//        return parent::create($attributes); // TODO: Change the autogenerated stub
    }

    public function updateAjax(array $attributes)
    {
        // TODO: Implement updateAjax() method.
    }
}