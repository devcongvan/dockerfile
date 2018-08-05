<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\SourceRepository;
use Illuminate\Http\Request;
use App\Http\Requests\SourceRequest;
use App\Model\Source;

class SourceController extends Controller
{
    protected $sourceRepository;

    public function __construct(SourceRepository $sourceRepository)
    {
        $this->sourceRepository=$sourceRepository;
    }


    public function index(Request $request){

        $condition = [];
        $name = strip_tags($request->get('name'));
        if (!empty($name))
        {
            $condition['wheres'] = [['so_name', 'like', '%' . $name . '%']];
        }

        $option = strip_tags($request->get('option'));
        if (!empty($option) && $option == 'new')
        {
            $condition['orderby'] = ['created_at', 'desc'];
        }

        $condition['paginate'] = 10;

        $sources=$this->sourceRepository->getAll($condition);


        return view('source.index',compact('sources'));
    }

    public function searchSelect2Ajax(Request $request){
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $searchText=$request->get('q');

        $result=$this->sourceRepository->search($searchText);

        $formatted_tags = [];

        foreach ($result as $item) {
            $formatted_tags[] = ['id' => $item->id, 'text' => $item->so_name];
        }

        return response($formatted_tags);

    }

    public function search(Request $request){
        $str=$request->get('term');

        $result= $this->sourceRepository->search($str);

//        $result=$request->all();

        return response($result);
    }

    public function store(){
        return view('source.add');
    }

    public function postStore(SourceRequest $request){

        $this->sourceRepository->create($request->all());

        return redirect('source/list')->with('success','Thêm nguồn thành công');
    }

    public function storePostAjax(SourceRequest $request){

        $arr=[
            'so_name'=>$request->get('so_name')
        ];

        $source=$this->sourceRepository->create($arr);

        return response([
            'message'=>'Thêm nguồn thành công',
            'result'=>$source
        ]);
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

    public function updatePostAjax(SourceRequest $request){

        $arr=[
            'id'=>$request->get('id'),
            'so_name'=>$request->get('so_name')
        ];

        $result=$this->sourceRepository->updateAjax($arr);

        return response([
            'message'=>'Sửa thành công',
            'result'=>$result
        ]);
    }

    public function destroy($id){
        if ($this->sourceRepository->delete($id)){
            return redirect('source/list')->with('success','Xóa thành công');
        }
        return redirect('source/list')->with('fail','Ngành nghề không tồn tại');
    }

    public function destroyAjax(Request $request){
        $id=$request->id;
        if ($this->sourceRepository->delete($id)){
            return response([
                'message' => 'Xóa thành công'
            ]);
        }

        return response([
            'message'=>'Xóa không thành công'
        ]);
    }




}
