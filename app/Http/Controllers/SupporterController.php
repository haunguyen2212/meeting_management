<?php

namespace App\Http\Controllers;

use App\Models\RoomRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupporterController extends Controller
{
    public function index(Request $request){
        $filter = $request->filter ?? 'new';
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $supporter_id = Auth::user()->supporter->id;
        
        $schedules = RoomRegistration::join('departments', 'department_id', '=', 'departments.id')
            ->join('types_support', 'type_sp_id', '=', 'types_support.id')
            ->leftJoin('rooms', 'room_id', '=', 'rooms.id')
            ->where('supporter_id', $supporter_id)
            ->where('status', 1)
            ->select('meet_name','test_time', 'end_time', DB::raw('departments.name as department_name, types_support.name as type_name, rooms.name as room_name'));

        switch($filter){
            case 'new':
                $schedules = $schedules->where('test_time', '>=', $now)->orderBy('test_time', 'asc')->paginate(10);
                break;
            case 'all':
                $schedules = $schedules->orderBy('test_time', 'desc')->paginate(10);
                break;
            default:
                $schedules = $schedules->where('test_time', '>=', $now)->orderBy('test_time', 'asc')->paginate(10);
        }
        return view('supporter.support', compact('schedules'));
    }
}
