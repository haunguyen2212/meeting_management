<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\RoomRegistration;
use App\Models\TypeSupport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function index(Request $request){ 
        $notifies = RoomRegistration::leftJoin('supporters', 'supporter_id', '=', 'supporters.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->leftJoin('members', 'account_id', '=', 'users.id')
            ->select('meet_name', 'type_sp_id', 'status', 'feedback', 'approval_time', 'assignment_time', DB::raw('members.name as supporter_name, supporters.id as supporter_id'))
            ->where('register_id', Auth::id())
            ->whereIn('status', [-1, 1])
            ->orderBy('approval_time', 'desc')
            ->take(15)
            ->get();

        if(Auth::user()->role_id != 4){
            $assignments = RoomRegistration::join('supporters', 'supporter_id', '=', 'supporters.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('members', 'account_id', '=', 'users.id')
            ->whereNotNull('supporter_id')
            ->select('supporter_id','meet_name', 'test_time', 'end_time' ,'assignment_time', DB::raw('members.name as supporter_name'))
            ->orderBy('assignment_time', 'desc')
            ->take(15)
            ->get();
        }
        else{
            $assignments = RoomRegistration::join('supporters', 'supporter_id', '=', 'supporters.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('members', 'account_id', '=', 'users.id')
            ->whereNotNull('supporter_id')
            ->where('register_id', Auth::id())
            ->select('supporter_id','meet_name', 'test_time', 'end_time' ,'assignment_time', DB::raw('members.name as supporter_name'))
            ->orderBy('assignment_time', 'desc')
            ->take(15)
            ->get(); 
        }
        
        $types = TypeSupport::select('id', 'name')->get();

        if(Auth::user()->role_id == 4){
            $department_id = Member::where('account_id', Auth::id())->first()->department_id;
            $num_registration = RoomRegistration::where('department_id', $department_id);
            $num_accept = RoomRegistration::where('department_id', $department_id)
                ->where('status', 1);
            $num_deny = RoomRegistration::where('department_id', $department_id)
                ->where('status', '-1');
            $num_pending = RoomRegistration::where('department_id', $department_id)
                ->where('status', 0);
            $num_type_meeting = [];
            foreach($types as $type){
                $num_type_meeting[$type->id] = RoomRegistration::where('department_id', $department_id)
                ->where('status', 1)
                ->where('type_sp_id', $type->id);
                
            }
        }
        else{
            $num_registration = RoomRegistration::select('*');
            $num_accept = RoomRegistration::where('status', 1);
            $num_deny = RoomRegistration::where('status', '-1');
            $num_pending = RoomRegistration::where('status', 0);
            $num_type_meeting = [];
            foreach($types as $type){
                $num_type_meeting[$type->id] = RoomRegistration::where('status', 1)
                ->where('type_sp_id', $type->id);
            }
        }

        if(isset($request->start) && isset($request->end)){
            $rules = [
                'start' => 'required|date_format:d-m-Y',
                'end' => 'required|date_format:d-m-Y|after_or_equal:start',
            ];

            $messages = [
                'start.required' => 'Chưa chọn ngày',
                'start.date_format' => 'Định dạng chưa đúng',
                'end.required' => 'Chưa chọn ngày',
                'end.date_format' => 'Định dạng chưa đúng',
                'end.after_or_equal' => 'Ngày chọn không hợp lệ',
            ];

            $request->validate($rules, $messages);

            $start = date('Y-m-d', strtotime($request->start));
            $end = date('Y-m-d', strtotime($request->end));
            
            $num_registration = $num_registration
                ->whereDate('end_time', '>=', $start)
                ->whereDate('end_time', '<=', $end)
                ->count();
            $num_accept = $num_accept
                ->whereDate('end_time', '>=', $start)
                ->whereDate('end_time', '<=', $end)
                ->count();
            $num_deny = $num_deny
                ->whereDate('end_time', '>=', $start)
                ->whereDate('end_time', '<=', $end)
                ->count();
            $num_pending = $num_pending->count();
            foreach($types as $type){
                $num_type_meeting[$type->id] = $num_type_meeting[$type->id]
                    ->whereDate('end_time', '>=', $start)
                    ->whereDate('end_time', '<=', $end)
                    ->count();
            }
        }
        else{
            $num_registration = $num_registration->count();
            $num_accept = $num_accept->count();
            $num_deny = $num_deny->count();
            $num_pending = $num_pending->count();
            foreach($types as $type){
                $num_type_meeting[$type->id] = $num_type_meeting[$type->id]->count();
            }
        }
        
        return view('shared.statistical', compact('notifies', 'assignments','num_registration', 'num_registration',
             'num_accept', 'num_deny', 'num_pending', 'types' ,'num_type_meeting'));
    }
}
