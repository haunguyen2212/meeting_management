<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomRegistration;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class MeetingScheduleController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');

        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);
        foreach ($period as $date) {
            $date->format('Y-m-d');
        }
        
        $dates = $period->toArray();

        $rooms = Room::select('id', 'name')->get();

        $schedules = [];

        foreach($rooms as $room){
            for ($i=0; $i <= 6; $i++) { 
                $schedules[$room->id][$i] = RoomRegistration::whereDate('test_time', '=', $dates[$i]->format('Y-m-d'))
                    ->where('room_id', $room->id)
                    ->where('status', 1)
                    ->select('id', 'meet_name', 'test_time', 'end_time')
                    ->orderBy('test_time', 'asc')
                    ->get();
            }
        }

        return view('shared.schedule', compact('rooms', 'dates','schedules'));
    }
}
