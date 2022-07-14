<?php

namespace App\Http\Controllers;

use App\Models\RoomRegistration;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegistrationApprovalController extends Controller
{
    public function index(Request $request){
        $filter = $request->filter ?? 'new';
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $meetings = RoomRegistration::join('departments', 'department_id', '=', 'departments.id')
            ->join('types_support', 'type_sp_id', '=' , 'types_support.id')
            ->leftJoin('rooms', 'room_id', '=', 'rooms.id')
            ->select('room_registrations.id', 'meet_name', 'test_time', 'start_time' ,'end_time', 'document', 'status', DB::raw('departments.name as department_name, types_support.name as type_name, rooms.name as room_name'))
            ->orderBy('test_time', 'asc');

        switch($filter){
            case 'new':
                $meetings = $meetings->where('test_time', '>=', $now)->where('status', 0)->paginate(10);
                break;
            case 'accept':
                $meetings = $meetings->where('status', 1)->paginate(10);
                break;
            case 'deny':
                $meetings = $meetings->where('status', -1)->paginate(10);
                break;
            default:
                $meetings = $meetings->paginate(10);
        }

        $meetings->appends(['filter' => $filter]);
        return view('leader.approval', compact('meetings'));
    }

    public function accept($id){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $meeting = RoomRegistration::find($id);
        $test_time = date("Y-m-d H:i:s", strtotime($meeting->test_time));
        $end_time = date("Y-m-d H:i:s", strtotime($meeting->end_time));
        if($meeting->type_sp_id == 1){
            $checkTime = RoomRegistration::where('room_id', $meeting->room_id)
                ->where('status', 1)
                ->where(function($query) use ($test_time, $end_time){
                    $query->whereBetween('test_time', [$test_time, $end_time])
                        ->orWhereBetween('end_time', [$test_time, $end_time])
                        ->orWhereRaw("'".$test_time."' BETWEEN test_time AND end_time")
                        ->orWhereRaw("'".$end_time."' BETWEEN test_time AND end_time");
                })->first();
            if($checkTime){
                Toastr::error('Phòng đã sử dụng cho cuộc họp "'.$checkTime->meet_name.'"', 'Không thành công');
                return response()->json(['status' => 0]);
            };
        }
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
        $rules = [
            'feedback' => 'required|max:500',
        ];

        $messages = [
            'feedback.required' => 'Chưa nhập phản hồi',
            'feedback.max' => 'Phản hồi quá dài',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

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
