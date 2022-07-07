<?php

namespace App\Http\Controllers;

use App\Models\RoomRegistration;
use App\Models\Supporter;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    
    public function index(Request $request)
    {
        $filter = $request->filter ?? 'new';
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $meetings = RoomRegistration::join('departments', 'department_id', '=', 'departments.id')
            ->leftJoin('supporters', 'supporter_id', '=', 'supporters.id')
            ->leftJoin('users', 'user_id', '=' ,'users.id')
            ->leftJoin('members', 'account_id', '=', 'users.id')
            ->select('room_registrations.id', 'meet_name', 'test_time', 'start_time', 'end_time', DB::raw('departments.name as department_name, members.name as supporter_name'))
            ->where('status', 1);

        switch($filter){
            case 'new':
                $meetings = $meetings->where('test_time', '>=', $now)->whereNull('supporter_id')->orderBy('test_time', 'asc')->paginate(10);
                break;
            case 'done':
                $meetings = $meetings->whereNotNull('supporter_id')->orderBy('test_time', 'desc')->paginate(10);
                break;
            default:
                $meetings = $meetings->orderBy('test_time', 'desc')->paginate(10);
        }

        $meetings->appends(['filter' => $filter]);
        
        $supporters = Supporter::join('users', 'user_id', '=', 'users.id')
            ->join('members', 'account_id', '=', 'users.id')
            ->where('hide', 0)
            ->select('supporters.id', 'members.name')
            ->get();
        return view('manager.assignment', compact('meetings', 'supporters'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['supporters'] = Supporter::join('users', 'user_id', '=', 'users.id')
            ->join('members', 'account_id', '=', 'users.id')
            ->where('hide', 0)
            ->select('supporters.id', 'members.name')
            ->get();
        
        $data['assignment'] = RoomRegistration::find($id)->supporter_id;
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
            'supporter' => 'exists:supporters,id',
        ];

        $messages = [
            'supporter.exists' => 'Mã cán bộ hỗ trợ không họp lệ',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $meeting = RoomRegistration::find($id);
        $test_time = $meeting->test_time;
        $end_time = $meeting->end_time;

        $checkTime = RoomRegistration::where('supporter_id', $request->supporter)
                ->where('status', 1)
                ->where(function($query) use ($test_time, $end_time){
                    $query->whereBetween('test_time', [$test_time, $end_time])
                        ->orWhereBetween('end_time', [$test_time, $end_time])
                        ->orWhereRaw("'".$test_time."' BETWEEN test_time AND end_time")
                        ->orWhereRaw("'".$end_time."' BETWEEN test_time AND end_time");
                })->first();
        if($checkTime){
            $error['supporter'] = ['Cán bộ này bận hỗ trợ cho cuộc họp khác'];
            return response()->json(['error' => $error,'status' => 0]);
        }

        $now = Carbon::now()->format('Y-m-d H:i:s');
        $update = $meeting->update([
            'supporter_id' => $request->supporter,
            'assignment_time' => $now,
        ]);

        if($update){
            Toastr::success('Đã phân công cán bộ cho cuộc họp', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }


    public function destroy($id)
    {
        //
    }

    public function hideSupporter($id){
        $update = Supporter::find($id)->update([
            'hide' => 1,
        ]);

        if($update){
            Toastr::success('Xóa thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function createSupporter(){
        $supporters = Supporter::where('hide', 0)->select('user_id')->get();
        $arr = [];
        foreach($supporters as $key => $supporter){
            $arr[$key] = $supporter->user_id;
        }
        $data = User::join('members', 'account_id', '=', 'users.id')
            ->whereNotIn('account_id', $arr)
            ->select('users.id', 'members.name')
            ->get();
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function storeSupporter(Request $request){
        $rules = [
            'user' => 'required|exists:users,id',
        ];

        $messages = [
            'user.required' => 'Chưa chọn cán bộ',
            'user.exists' => 'Mã cán bộ không tồn tại',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $store = Supporter::create([
            'user_id' => $request->user,
        ]);

        if($store){
            Toastr::success('Thêm thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }
}
