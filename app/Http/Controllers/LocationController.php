<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\LocationRepository;

class LocationController extends Controller
{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository=$locationRepository;
    }

    public function searchAjaxSelect2(Request $request){
        
        $term = trim($request->loc_name);

        $condition['wheres']=[];

        if ($request->has('loc_name')){
            $condition['wheres'][]=['loc_name','like','%'.$term.'%'];
        }
        if ($request->has('loc_parent_id')){
            $condition['wheres'][] = ['loc_parent_id', '=', $request->get('loc_parent_id')];
        }

        $result=$this->locationRepository->getAll($condition);

        $formatted_tags = [];

        foreach ($result as $item) {
            $formatted_tags[] = ['id' => $item->id, 'text' => $item->loc_name];
        }

        return response($formatted_tags);

    }

    public function test(Request $request){
        
        $result=$this->locationRepository->search(['loc_parent_id'=>$request->get('parentId')]);

        return response($result->toArray());
    }


}
