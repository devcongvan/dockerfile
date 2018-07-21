<?php

namespace App\Http\Controllers;

use App\Repositories\Candidate\CandidateEloquentRepository;
use App\Repositories\CandidateType\CandidateTypeEloquentRepository;
use Illuminate\Http\Request;
use App\Repositories\Diary\DiaryEloquentRepository;
use Elasticsearch\ClientBuilder;

class DiaryController extends Controller
{
    protected $diaryRepository;
    protected $candidateTypeRepository;
    protected $candidateRepository;

    public function __construct(DiaryEloquentRepository $diaryEloquentRepository,CandidateTypeEloquentRepository $candidateTypeEloquentRepository,
CandidateEloquentRepository $candidateEloquentRepository)
    {
        $this->diaryRepository=$diaryEloquentRepository;
        $this->candidateTypeRepository=$candidateTypeEloquentRepository;
        $this->candidateRepository=$candidateEloquentRepository;
    }

    public function index(Request $request){
        $condition=[
            'with'=>'candidateType',
            'where'=>['d_can_id'=>$request->get('d_can_id')],
            'orderby'=>[
                'field'=>'id',
                'type'=>'DESC'
            ],
            'limit'=>$request->get('limit'),
            'start'=>$request->get('start'),
        ];

        $result=$this->diaryRepository->getAll($condition);

        if (!is_object($result)){
            return response([
                'message'=>'Nhật ký đã được tải hết'
            ]);
        }else{
            return response([
                'result'=>$result
            ]);
        }
    }

    public function indexCandidateType(){
        $candidateType=$this->candidateTypeRepository->getAll();

        return response([
            'candidate_types'=>$candidateType
        ]);
    }

    public function storeAjax(Request $request){
        $diary=$request->data;

        $lastDiary=$this->diaryRepository->getLast();
        $currentMonth=date('m');
        $lastMonth=date('m',strtotime($lastDiary->created_at));

        if ($lastMonth<$currentMonth){
            $dateString='Tháng '.$lastMonth.' năm '.date('Y',strtotime($lastDiary->created_at));
            $arr=[
                'd_cantype_id'=>0,
                'd_can_id'=>$diary['d_can_id'],
                'd_breaktime'=>$dateString
            ];

            $breaktime=$this->diaryRepository->create($arr);
        }

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

            if ($diaryReceive=$this->diaryRepository->create($arr)){

                $oop=[
                    'diary'=>json_encode($diaryReceive),
                    'candidateType'=>json_encode($diaryReceive->candidateType)
                ];
                $this->candidateRepository->update($diary['d_can_id'],['can_diary'=>json_encode($oop)]);

                return response([
                    'message'=>'Thêm nhật ký thành công',
                    'breaktime'=>isset($breaktime)?$breaktime:false,
                    'result'=>$diaryReceive,
                    'candidateType'=>$diaryReceive->candidateType,
                    'type'=>'success'
                ]);
            }



        }

        return response([
            'message'=>'Đã có lỗi xảy ra. Vui lòng kiểm tra lại các trường đã nhập',
            'type'=>'warning'
        ]);

    }

    public function destroyAjax(Request $request){
        $id=$request->get('id');

        $prevItemId=$this->diaryRepository->getAll(['where'=>[['id','<',$id]],'max'=>'id']);
        $nextItemId=$this->diaryRepository->getAll(['where'=>[['id','>',$id]],'min'=>'id']);

        $nextItem=$this->diaryRepository->getById($nextItemId);
        $prevItem=$this->diaryRepository->getById($prevItemId);

        if (!empty($nextItem->d_breaktime)&&!empty($prevItem->d_breaktime)){
            $this->diaryRepository->delete($nextItemId);
        }

        if ($this->diaryRepository->delete($id)){
            return response([
                'type'=>'success',
                'message'=>'Đã xóa một nhật ký',
                'prev'=>$prevItem,
                'next'=>$nextItem
            ]);
        }

        return response([
            'type'=>'warning',
            'message'=>'Đã có lỗi xảy ra. Vui lòng load lại trang và thực hiện lại thao tác vừa rồi!'
        ]);

    }

    public function testdiary(){
        $arr=[
            'can_diary'=>'sadfaskdfjhaskdfhskjdfhaskjd'
        ];
        $candidate=$this->candidateRepository->update(29,$arr);

        dd($candidate);
    }

    public function test_elastic(){
        $host=[
            '127.0.0.1:80',         // IP + Port
//            '192.168.1.2',              // Just IP
//            'mydomain.server.com:9201', // Domain + Port
//            'mydomain2.server.com',     // Just Domain
//            'https://localhost',        // SSL to localhost
//            'https://192.168.1.3:9200'
        ];
        $client=ClientBuilder::create()->setHosts($host)->build();

        $params = [
            'index' => 'my_index'
        ];

//        echo $client->get($params);

        dump($client);
    }
}
