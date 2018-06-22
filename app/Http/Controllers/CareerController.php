<?php

namespace App\Http\Controllers;

use App\Model\Career;
use App\Repositories\Career\CareerEloquentRepository;
use App\Http\Requests\CareerRequest;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    protected $careerRepository;

    public function __construct(CareerEloquentRepository $career)
    {
        $this->careerRepository=$career;
    }

    public function index(Request $request)
    {

        $searchName = $request->get('name');

        $condition  = [];

        $condition['name'] = $searchName;
        $condition['orderByCaName'] = 'Desc';

        $condition['orderById']='Desc';

        $condition['searchOption']=$request->get('option');

        $careers=$this->careerRepository->getAll($condition,12);

        return view('career.index',compact('careers'));
    }

    public function indexAjax(){
        return json_encode($this->careerRepository->getAll());
    }

    public function show(){

    }

    public function showAjax($id){
        $career=$this->careerRepository->getById($id);

        return json_encode($career);
    }

    public function store(){
        return view('career.add');
    }

    public function storePost(CareerRequest $request){

        $this->careerRepository->create($request->all());

        return redirect('career/list')->with('success','Thêm thành công');
    }

    public function storePostAjax(CareerRequest $request){

        $arr=[

        ];

        $career=$this->careerRepository->create($request->all());

        return response([
            'message'=>'Thêm ngành nghề thành công',
            'result'=>$career
        ]);

    }

    public function update($id){
        $career=$this->careerRepository->getById($id);
        if (!empty($career)){
            return view('career.edit',compact('career'));
        }
        return redirect('career/list')->with('fail','Ngành nghề không tồn tại');
    }

    public function updatePost($id,CareerRequest $request){

        if ($this->careerRepository->update($id,$request->all())){
            return redirect('career/list')->with('success','Sửa thành công');
        }

        return redirect('career/list')->with('fail','Sửa ngành nghề không thành công');

    }

    public function updatePostAjax(CareerRequest $request){

        $result=$this->careerRepository->updateAjax($request->all());

        return response([
            'message'=>'Sửa thành công',
            'result'=>$result
        ]);

    }

    public function destroy($id){
        if ($this->careerRepository->delete($id)){
            return redirect('career/list')->with('success','Xóa thành công');
        }
            return redirect('career/list')->with('fail','Ngành nghề không tồn tại');
    }

    public function destroyAjax($id){

        return $this->careerRepository->delete($id);

    }
}
