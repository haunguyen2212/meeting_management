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
        $filter = $request->filter ?? 'all';
        $months = RoomRegistration::select(DB::raw('DISTINCT LEFT(test_time, 7) as month'))->get();
        $types = TypeSupport::select('id', 'name')->get();

        if(Auth::user()->role_id == 4){
            $department_id = Member::where('account_id', Auth::id())->first()->department_id;
            $dataChart = RoomRegistration::where('status', 1)
                ->where('department_id', $department_id)
                ->groupBy(DB::raw('MONTH(test_time)'))
                ->selectRaw('MONTH(test_time) as month, COUNT(*) as total')
                ->get();
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
            $dataChart = RoomRegistration::where('status', 1)
                ->groupBy(DB::raw('MONTH(test_time)'))
                ->selectRaw('MONTH(test_time) as month, COUNT(*) as total')
                ->get();
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

        $chartArr = array(0, 0, 0, 0, 0, 0, 0, 0 , 0, 0, 0, 0);
        foreach($dataChart as $value){
            $chartArr[--$value->month] = $value->total;
        }

        switch($filter){
            case 'all':
                $num_registration = $num_registration->count();
                $num_accept = $num_accept->count();
                $num_deny = $num_deny->count();
                $num_pending = $num_pending->count();
                foreach($types as $type){
                    $num_type_meeting[$type->id] = $num_type_meeting[$type->id]->count();
                }
                break;
            case 'week':
                $now = Carbon::now();
                $weekStartDate = $now->startOfWeek()->format('Y-m-d');
                $weekEndDate = $now->endOfWeek()->format('Y-m-d');
                $num_registration = $num_registration->where('test_time', '>=', $weekStartDate)
                    ->where('test_time', '<=', $weekEndDate)
                    ->count();
                $num_accept = $num_accept->where('test_time', '>=', $weekStartDate)
                    ->where('test_time', '<=', $weekEndDate)
                    ->count();
                $num_deny = $num_deny->where('test_time', '>=', $weekStartDate)
                    ->where('test_time', '<=', $weekEndDate)
                    ->count();
                $num_pending = $num_pending->where('test_time', '>=', $weekStartDate)
                    ->where('test_time', '<=', $weekEndDate)
                    ->count();
                foreach($types as $type){
                    $num_type_meeting[$type->id] = $num_type_meeting[$type->id]->where('test_time', '>=', $weekStartDate)
                    ->where('test_time', '<=', $weekEndDate)
                    ->count();
                }
                break;
            default:
                $num_registration = $num_registration->where(DB::raw('LEFT(test_time, 7)'), $filter)->count();
                $num_accept = $num_accept->where(DB::raw('LEFT(test_time, 7)'), $filter)->count();
                $num_deny = $num_deny->where(DB::raw('LEFT(test_time, 7)'), $filter)->count();
                $num_pending = $num_pending->where(DB::raw('LEFT(test_time, 7)'), $filter)->count();
                foreach($types as $type){
                    $num_type_meeting[$type->id] = $num_type_meeting[$type->id]->where(DB::raw('LEFT(test_time, 7)'), $filter)->count();
                }
        }
        
        return view('shared.statistical', compact('months', 'num_registration', 'num_registration',
             'num_accept', 'num_deny', 'num_pending', 'types' ,'num_type_meeting', 'chartArr'));
    }
}
