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
        $diary=$this->candidateTypeRepository->getAll();

        return response([
            'candidate_types'=>$diary
        ]);
    }

    public function getCandidateType(){
        $diary=$this->candidateTypeRepository->getAll();
        dd($diary);
    }

    public function store(Request $request){
        $diary=$request->data;

        if (!empty($diary['d_can_id'])&&!empty($diary['d_cantype_id'])){
            $arr=[
                'd_cantype_id'=>$diary['d_cantype_id'],
                'd_can_id'=>$diary['d_can_id'],
                'd_evaluate'=>$diary['d_evaluate'],
                'd_set_calendar'=>$diary['d_set_calendar'],
                'd_set_time'=>$diary['d_set_time'],
                'd_notice_before'=>$diary['d_notice_before'],
                'd_note'=>$diary['d_note']

            ];
            if ($obj=$this->diaryRepository->create($arr)){
                return response([
                    'message'=>'Thêm nhật ký thành công',
                    'result'=>$obj
                ]);
            }
        }

        return response([
            'message'=>'Đã có lỗi xảy ra. Vui lòng kiểm tra lại các trường đã nhập'
        ]);

    }
}
