<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::select('id', 'name')->paginate(8);
        return view('admin.room', compact('rooms'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name_add' => 'required',
        ];

        $messages = [
            'name_add.required' => 'Tên phòng không được bỏ trống',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $name = $request->name_add;
        $create = Room::create([
            'name' => $name,
        ]);

        if($create){
            Toastr::success('Thêm phòng thành công', 'Thành công');
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
        $data = Room::select('name')->find($id);
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
            'name_edit' => 'required',
        ];

        $messages = [
            'name_edit.required' => 'Tên phòng không được bỏ trống',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $name = $request->name_edit;
        $update = Room::find($id)->update([
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
        $delete = Room::find($id)->delete();
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
