<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 1:46 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\Skill;
use App\Repositories\EloquentRepository;

class SkillRepository extends EloquentRepository
{
    public function setModel()
    {
        return Skill::class;
        // TODO: Implement setModel() method.
    }
}

?>