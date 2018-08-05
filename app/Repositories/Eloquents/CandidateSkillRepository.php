<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 2:59 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\CandidateSkill;
use App\Repositories\EloquentRepository;

class CandidateSkillRepository extends EloquentRepository
{
    public function setModel()
    {
        return CandidateSkill::class;
        // TODO: Implement setModel() method.
    }
}

?>