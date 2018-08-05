<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 2:57 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\CandidateCareer;
use App\Repositories\EloquentRepository;

class CandidateCareerRepository extends EloquentRepository
{
    public function setModel()
    {
        return CandidateCareer::class;
        // TODO: Implement setModel() method.
    }
}

?>