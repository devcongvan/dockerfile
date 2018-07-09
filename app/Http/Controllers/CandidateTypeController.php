<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CandidateType\CandidateTypeEloquentRepository;

class CandidateTypeController extends Controller
{
    protected $candidateTypeRepository;

    public function __construct(CandidateTypeEloquentRepository $candidateTypeEloquentRepository)
    {
        $this->candidateTypeRepository=$candidateTypeEloquentRepository;
    }

    public function index(){

    }

    public function indexAjax(){
        $candidateTypes=$this->candidateTypeRepository->getAll();

        return response([
            'list_candidate'=>$candidateTypes
        ]);
    }


}
