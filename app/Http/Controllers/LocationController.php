<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Location\LocationEloquentRepository;

class LocationController extends Controller
{
    protected $locationRepository;

    public function __construct(LocationEloquentRepository $locationEloquentRepository)
    {
        $this->locationRepository=$locationEloquentRepository;
    }

    public function searchAjaxSelect2(Request $request){
        
        $term = trim($request->loc_name);



        $searchArray=[];

        if ($request->has('loc_name')){
            $searchArray['loc_name']=$request->get('loc_name');
        }

        if ($request->has('loc_parent_id')){
            $searchArray['loc_parent_id']=$request->get('loc_parent_id');
        }

        $result=$this->locationRepository->search($searchArray);

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
