<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/07/2018
 * Time: 11:03 AM
 */

namespace App\Repositories\Eloquents;
use App\Model\Candidate;
use App\Repositories\EloquentRepository;

class CandidateRepository extends EloquentRepository
{

    public function setModel()
    {
        return Candidate::class;
        // TODO: Implement setModel() method.
    }

    public function getOneByElastic($id){
        $condition=['candidateInfo', 'career:cc_careers_id,ca_name,ca_slug', 'skill:cs_skills_id,sk_name,sk_slug', 'latest_diary', 'source:id,so_name,so_slug', 'location:wp_locations_id,loc_name,loc_slug', 'candidateType' => function ($query) {
                $query->orderBy('id', 'desc');
            }];

        return $this->getById($id,$condition);
    }

}

?>