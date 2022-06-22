<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomRegistration;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingManagementController extends Controller
{
    public function index(Request $request){
        $filter = $request->filter ?? 'all';
        $now = Carbon::now();

        $meetings = RoomRegistration::join('departments', 'department_id', '=', 'departments.id')
                ->join('types_support', 'type_sp_id', '=', 'types_support.id')
                ->leftJoin('rooms', 'room_id', '=', 'rooms.id')
                ->leftJoin('supporters', 'supporter_id', '=', 'supporters.id')
                ->leftJoin('users', 'user_id', '=', 'users.id')
                ->leftJoin('members', 'account_id', '=', 'users.id')
                ->select('room_registrations.id', 'meet_name', 'test_time', 'end_time', 'status', DB::raw('members.name as supporter_name, rooms.name as room_name, departments.name as department_name, types_support.name as type_name'));
        
        switch($filter){
            case 'all':
                $meetings = $meetings->paginate(10);
                break;
            case 'new':
                $meetings = $meetings->where('test_time', '>=', $now)->paginate(10);
                break;
            case 'now':
                $meetings = $meetings->whereDate('test_time', '=', $now)->paginate(10);
                break;
            default:
                $date = Carbon::now()->addDays(-$filter);
                $meetings = $meetings->where('test_time', '>=', $date)->where('test_time', '<', $now)->paginate(10);
        }

        $meetings->appends(['filter' => $filter]);

        return view('admin.meeting', compact('meetings'));
    }

    public function show($id){
        $data = [];
        $data['info'] = RoomRegistration::select('meet_name', 'test_time', 'start_time', 'end_time', 'status', 'approval_time', 'document', 'feedback')->find($id);
        $data['type'] = RoomRegistration::join('types_support', 'type_sp_id', '=', 'types_support.id')->select('name')->find($id);
        $data['department'] = RoomRegistration::join('departments', 'department_id', '=', 'departments.id')->select('name')->find($id);
        $data['room'] = RoomRegistration::join('rooms', 'room_id', '=', 'rooms.id')->select('name')->find($id);
        $data['register'] = RoomRegistration::join('users', 'register_id', '=', 'users.id')
            ->join('members', 'account_id', '=', 'users.id')
            ->select('members.name')
            ->find($id);
        $data['supporter'] =  RoomRegistration::join('supporters', 'supporter_id', '=', 'supporters.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('members', 'account_id', '=', 'users.id')
            ->select('members.name')
            ->find($id);

        if(empty($data['info']) || empty($data['type']) || empty($data['department']) || empty($data['register'])){
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }
}
