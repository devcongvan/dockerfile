<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 11:57 AM
 */

namespace App\Repositories\Eloquents;
use App\Model\Location;
use App\Repositories\EloquentRepository;

class LocationRepository extends EloquentRepository
{
    public function setModel()
    {
        return Location::class;
        // TODO: Implement setModel() method.
    }
}

?>