<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Repositories\Skill\SkillEloquentRepository;

class SkillController extends Controller
{
    protected $skillRepository;

    public function __construct(SkillEloquentRepository $skillEloquentRepository)
    {
        $this->skillRepository=$skillEloquentRepository;
    }

    public function index(){

        $skills=$this->skillRepository->getAll();

        return view('skill.index',compact('skills'));
    }

    public function store(){
        return view('skill.add');
    }

    public function postStore(SkillRequest $request){

        $this->skillRepository->create($request->all());

        return redirect('skill/list')->with('success','Thêm kỹ năng thành công');
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

    public function destroy($id){
        if ($this->skillRepository->delete($id)){
            return redirect('skill/list')->with('success','Xóa thành công');
        }
        return redirect('skill/list')->with('fail','Kỹ năng không tồn tại');
    }
}
