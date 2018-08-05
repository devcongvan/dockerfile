<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 11:51 AM
 */

namespace App\Repositories\Eloquents;
use App\Model\Source;
use App\Repositories\EloquentRepository;

class SourceRepository extends EloquentRepository
{
    public function setModel()
    {
        return Source::class;
        // TODO: Implement setModel() method.
    }
}

?>