<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomRegistration;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class MeetingScheduleController extends Controller
{

    public function getSchedule(){
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');

        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);
        
        $dates = $period->toArray();

        $rooms = Room::select('id', 'name')->get();

        $schedules_1 = [];

        foreach($rooms as $room){
            for ($i=0; $i <= 6; $i++) { 
                $schedules_1[$room->id][$i] = RoomRegistration::whereDate('test_time', '=', $dates[$i]->format('Y-m-d'))
                    ->where('room_id', $room->id)
                    ->where('status', 1)
                    ->select('id', 'meet_name', 'test_time', 'end_time')
                    ->orderBy('test_time', 'asc')
                    ->get();
            }
        }

        for($i=0; $i <= 6; $i++){
            $schedules_2[$i] = RoomRegistration::whereDate('test_time', '=' ,$dates[$i]->format('Y-m-d'))
                ->where('type_sp_id', 2)
                ->where('status', 1)
                ->select('id', 'meet_name', 'test_time', 'end_time')
                ->orderBy('test_time', 'asc')
                ->get();
            $schedules_3[$i] = RoomRegistration::whereDate('test_time', '=' ,$dates[$i]->format('Y-m-d'))
                ->where('type_sp_id', 3)
                ->where('status', 1)
                ->select('id', 'meet_name', 'test_time', 'end_time')
                ->orderBy('test_time', 'asc')
                ->get();
        }    

        return [$rooms, $dates, $schedules_1, $schedules_2, $schedules_3];
    }

    public function index(){
        [$rooms, $dates, $schedules_1, $schedules_2, $schedules_3] = $this->getSchedule();
        return view('shared.schedule', compact('rooms', 'dates','schedules_1', 'schedules_2', 'schedules_3'));
    }

    public function printPDF(){
        [$rooms, $dates, $schedules_1, $schedules_2, $schedules_3] = $this->getSchedule();
        $data = [
            'rooms' => $rooms,
            'dates' => $dates,
            'schedules_1' => $schedules_1,
            'schedules_2' => $schedules_2,
            'schedules_3' => $schedules_3
        ];
        $pdf = PDF::loadView('shared.printschedule', $data);
        return $pdf->download('lich-su-dung-phong-hop.pdf');
    }
}
