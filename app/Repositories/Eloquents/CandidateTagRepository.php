<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07/08/2018
 * Time: 5:23 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\CandidateTag;
use App\Repositories\EloquentRepository;

class CandidateTagRepository extends EloquentRepository
{
    public function setModel()
    {
        return CandidateTag::class;
        // TODO: Implement setModel() method.
    }
}

?>