<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/08/2018
 * Time: 10:35 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\Workplace;
use App\Repositories\EloquentRepository;

class WorkplaceRepository extends EloquentRepository
{
    public function setModel()
    {
        return Workplace::class;
        // TODO: Implement setModel() method.
    }


}

?>