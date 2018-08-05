<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01/08/2018
 * Time: 2:54 PM
 */

namespace App\Repositories\Eloquents;
use App\Model\Diary;
use App\Repositories\EloquentRepository;

class DiaryRepository extends EloquentRepository
{
    public function setModel()
    {
        return Diary::class;
        // TODO: Implement setModel() method.
    }
}

?>