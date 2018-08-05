<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/08/2018
 * Time: 10:42 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\CandidateInfo;
use App\Repositories\EloquentRepository;

class CandidateInfoRepository extends EloquentRepository
{
    public function setModel()
    {
        return CandidateInfo::class;
        // TODO: Implement setModel() method.
    }
}

?>