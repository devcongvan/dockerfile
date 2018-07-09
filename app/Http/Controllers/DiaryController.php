<?php

namespace App\Http\Controllers;

use App\Repositories\CandidateType\CandidateTypeEloquentRepository;
use Illuminate\Http\Request;
use App\Repositories\Diary\DiaryEloquentRepository;

class DiaryController extends Controller
{
    protected $diaryRepository;
    protected $candidateTypeRepository;

    public function __construct(DiaryEloquentRepository $diaryEloquentRepository,CandidateTypeEloquentRepository $candidateTypeEloquentRepository)
    {
        $this->diaryRepository=$diaryEloquentRepository;
        $this->candidateTypeRepository=$candidateTypeEloquentRepository;
    }

    public function index(){

    }

    public function getCandidateType(){
        $diary=$this->candidateTypeRepository->getAll();
        dd($diary);
    }
}
