<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SourceRequest;
use App\Model\Source;
use App\Repositories\Source\SourceEloquentRepository;

class SourceController extends Controller
{
    protected $sourceRepository;

    public function __construct(SourceEloquentRepository $sourceEloquentRepository)
    {
        $this->sourceRepository=$sourceEloquentRepository;
    }


    public function index(){

        $sources=$this->sourceRepository->getAll();


        return view('source.index',compact('sources'));
    }

    public function store(){
        return view('source.add');
    }

    public function postStore(SourceRequest $request){

        $this->sourceRepository->create($request->all());

        return redirect('source/list')->with('success','Thêm nguồn thành công');
    }

    public function update($id){
        $source=$this->sourceRepository->getById($id);

        if (!empty($source)){
            return view('source.edit',compact('source'));
        }
        return redirect('source/list')->with('fail','Nguồn không tồn tại');
    }

    public function postUpdate($id,SourceRequest $request){

        if ($this->sourceRepository->update($id,$request->all())){
            return redirect('source/list')->with('success','Sửa thành công');
        }

        return redirect('source/list')->with('fail','Sửa nguồn không thành công');

    }

    public function destroy($id){
        if ($this->sourceRepository->delete($id)){
            return redirect('source/list')->with('success','Xóa thành công');
        }
        return redirect('source/list')->with('fail','Ngành nghề không tồn tại');
    }




}
