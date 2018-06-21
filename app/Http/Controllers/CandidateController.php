<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Career\CareerEloquentRepository;
use App\Repositories\Skill\SkillEloquentRepository;
use App\Repositories\Source\SourceEloquentRepository;

class CandidateController extends Controller
{
    protected $careerRepository;
    protected $skillRepository;
    protected $sourceRepository;

    public function __construct(CareerEloquentRepository $careerEloquentRepository,
                                SkillEloquentRepository $skillEloquentRepository,
                                SourceEloquentRepository $sourceEloquentRepository)
    {
        $this->careerRepository=$careerEloquentRepository;
        $this->skillRepository=$skillEloquentRepository;
        $this->sourceRepository=$sourceEloquentRepository;
    }


    public function index()
    {

        return view('candidate.index');
    }

    public function store(){
        $skills=$this->skillRepository->getAll();
        $careers=$this->careerRepository->getAll();

        $data=[
            'skills'=>$skills,
            'careers'=>$careers
        ];

        return view('candidate.add',$data);
    }
}
