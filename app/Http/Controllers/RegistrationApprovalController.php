<?php

namespace App\Http\Controllers;

use App\Models\RoomRegistration;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationApprovalController extends Controller
{
    public function index(){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $meetings = RoomRegistration::join('departments', 'department_id', '=', 'departments.id')
            ->join('types_support', 'type_sp_id', '=' , 'types_support.id')
            ->leftJoin('rooms', 'room_id', '=', 'rooms.id')
            ->where('test_time', '>=', $now)
            ->select('room_registrations.id', 'meet_name', 'test_time', 'start_time' ,'end_time', 'document', 'status', DB::raw('departments.name as department_name, types_support.name as type_name, rooms.name as room_name'))
            ->orderBy('test_time', 'asc')
            ->get();
        return view('leader.approval', compact('meetings'));
    }

    public function accept($id){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $meeting = RoomRegistration::find($id);
        $update = $meeting->update([
            'status' => 1,
            'approval_time' => $now,
            'feedback' => NULL,
        ]);

        if($update){
            Toastr::success('Cuộc họp đã được chấp thuận', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function deny(Request $request, $id){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $meeting = RoomRegistration::find($id);
        $update = $meeting->update([
            'status' => -1,
            'approval_time' => $now,
            'feedback' => $request->feedback,
        ]);

        if($update){
            Toastr::success('Cuộc họp đã bị từ chối, phản hồi sẽ được gửi đến người đăng ký', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }
}
