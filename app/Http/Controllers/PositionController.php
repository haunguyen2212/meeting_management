<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{

    public function index()
    {
        $positions = Position::select('id', 'name')->paginate(10);
        return view('admin.position', compact('positions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name_add' => 'required|max:50',
        ];

        $messages = [
            'name_add.required' => 'Tên không được bỏ trống',
            'name_add.max' => 'Tên chức vụ quá dài',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $name = $request->name_add;
        $create = Position::create([
            'name' => $name,
        ]);

        if($create){
            Toastr::success('Thêm chức vụ thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau');
            return response()->json(['status' => 0]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Position::select('name')->find($id);
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name_edit' => 'required|max:50',
        ];

        $messages = [
            'name_edit.required' => 'Tên chức vụ không được bỏ trống',
            'name_edit.max' => 'Tên chức vụ quá dài',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $name = $request->name_edit;
        $update = Position::find($id)->update([
            'name' => $name,
        ]);

        if($update){
            Toastr::success('Chỉnh sửa thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function destroy($id)
    {
        $delete = Position::find($id)->delete();
        if($delete){
            Toastr::success('Xóa thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }
}
