<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Member;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Member::rightJoin('departments', 'department_id', '=' ,'departments.id')
                ->select('departments.id', 'departments.name', DB::raw('count(members.id) as number_member'))
                ->groupBy('departments.id', 'departments.name')
                ->paginate(8);
        return view('admin.department', compact('departments'));
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
            'name_add.required' => 'Tên đơn vị không được bỏ trống',
            'name_add.max' => 'Tên đơn vị quá dài',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $name = $request->name_add;
        $create = Department::create([
            'name' => $name,
        ]);

        if($create){
            Toastr::success('Thêm đơn vị thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau');
            return response()->json(['status' => 0]);
        }
    }

    public function show($id)
    {
        $data = [];
        $data['name'] = Department::find($id)->name;
        $data['qty'] = Member::where('department_id', $id)->count();
        $data['members'] = Member::join('positions', 'position_id', '=', 'positions.id')
            ->where('department_id', $id)
            ->select('members.name', DB::raw('positions.name as position_name'))
            ->get();

        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function edit($id)
    {
        $data = Department::select('name')->find($id);
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
            'name_edit.required' => 'Tên đơn vị không được bỏ trống',
            'name_edit.max' => 'Tên đơn vị quá dài',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $name = $request->name_edit;
        $update = Department::find($id)->update([
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
        $delete = Department::find($id)->delete();
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
