<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 11:50 AM
 */

namespace App\Repositories\Eloquents;
use App\Model\CandidateType;
use App\Repositories\EloquentRepository;

class CandidateTypeRepository extends EloquentRepository
{
    public function setModel()
    {
        return CandidateType::class;
        // TODO: Implement setModel() method.
    }
}

?>