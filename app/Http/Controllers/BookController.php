<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Model\Candidate;
use Illuminate\Support\Facades\DB;
use App\Model\Diary;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function copyToElastic()
    {
        Book::addAllToIndex();
    }


    public function index(Request $request)
    {
        $cans=[];

        $candidate=Candidate::with(['candidateInfo','career:ca_name,ca_slug','skill:sk_name,sk_slug','diary','source:so_name,so_slug','location:loc_name,loc_slug'])->get();

//        $candidate->addToIndex();

        if (!empty($request->can_name)){
//            $cans=Candidate::searchByQuery(
//                [
//                    "bool" => [
//                        "must" => [
//                            ["term" => [
//                                "can_name" => [
//                                    "value"=> $request->get('can_name')
//                                ]
//                            ]
//                            ]
//                        ]
//                    ]
//                ],
//                [
//                    "group_by_state"=>["terms"=>["field"=>"can_gender"]]
//                ],
//                [],
//                [],
//                [],
//                ['id'=>'desc']
//            );


            $cans=Candidate::searchByQuery();
        }

        return view('testelastic.itemsearch',compact('cans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->get('bk_name'))&&!empty($request->get('bk_quantity'))&&!empty($request->get('bk_price'))){

            $arr=[
                'bk_name'=>'dfsdf',
                'bk_quantity'=>5345,
                'bk_price'=>5354345
            ];

            $field = [
                'bk_name', 'bk_quantity', 'bk_price'
            ];
            $book = new Book();
            foreach ($field as $item) {
                $book->$item = $request->$item;
            }
            $book->save();
            $book->addToIndex();
            dd($book);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
