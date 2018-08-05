<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 1:29 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\Career;
use App\Repositories\EloquentRepository;

class CareerRepository extends EloquentRepository
{
    public function setModel()
    {
        return Career::class;
        // TODO: Implement setModel() method.
    }
}

?>