<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquents\SkillRepository;

class SkillController extends Controller
{
    protected $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository=$skillRepository;
    }

    public function index(Request $request){

        $condition = [];
        $name = strip_tags($request->get('name'));
        if (!empty($name))
        {
            $condition['wheres'] = [['ca_name', 'like', '%' . $name . '%']];
//            dd($condition);
        }

        $option = strip_tags($request->get('option'));
        if (!empty($option) && $option == 'new')
        {
            $condition['orderby'] = ['created_at', 'desc'];
        }

        $condition['paginate'] = 10;

        $skills=$this->skillRepository->getAll($condition);

        return view('skill.index',compact('skills'));
    }

    public function show(){

    }

    public function searchAjaxSelect2(Request $request){

        $searchText=$request->get('q');

        $condition['wheres']=[
            ['sk_name', 'like', '%' . $searchText . '%']
        ];

        $result=$this->skillRepository->getAll($condition);

        $formatted_tags = [];

        foreach ($result as $item) {
            $formatted_tags[] = ['id' => $item->id, 'text' => $item->sk_name];
        }

        return response($formatted_tags);
    }

    public function store(){
        return view('skill.add');
    }

    public function postStore(SkillRequest $request){

        $this->skillRepository->create($request->all());

        return redirect('skill/list')->with('success','Thêm kỹ năng thành công');
    }

    public function storePostAjax(SkillRequest $request){
        $arr=[
            'sk_name'=>$request->get('sk_name')
        ];


        $skills=$this->skillRepository->create($arr);

        return response([
            'message'=>'Thêm kỹ năng thành công',
            'result'=>$skills
        ]);
    }

    public function update($id){
        $skill=$this->skillRepository->getById($id);

        if (!empty($skill)){
            return view('skill.edit',compact('skill'));
        }

        return redirect('skill/list')->with('fail','Kỹ năng không tồn tại');

    }

    public function postUpdate($id,SkillRequest $request){
        if ($this->skillRepository->update($id,$request->all())){
            return redirect('skill/list')->with('success','Sửa thành công');
        }

        return redirect('skill/list')->with('fail','Sửa kỹ năng không thành công');
    }

    public function updatePostAjax(SkillRequest $request){

        $arr=[
            'id'=>$request->get('id'),
            'sk_name'=>$request->get('sk_name')
        ];

        $result=$this->skillRepository->updateAjax($arr);

        return response([
            'message'=>'Sửa kỹ năng thành công',
            'result'=>$result
        ]);

    }

    public function destroy($id){
        if ($this->skillRepository->delete($id)){
            return redirect('skill/list')->with('success','Xóa thành công');
        }
        return redirect('skill/list')->with('fail','Kỹ năng không tồn tại');
    }

    public function destroyAjax(Request $request){

        $this->skillRepository->delete($request->get('id'));

        return response([
            'message'=>'Xóa kỹ năng thành công thành công'
        ]);
    }
}
