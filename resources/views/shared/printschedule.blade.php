<!DOCTYPE html>
<html lang="vn">
<head>
    <base href="{{asset('frontend')}}/">
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In lịch họp</title>
    <link rel="stylesheet" href="./dist/css/style.css">
    <link rel="stylesheet" href="./dist/css/schedule.css">
</head>
<body>
    <div class="recent-grid grid-col-100">
        <div class="meeting-schedule">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="min-width: 600px">
                            <thead>
                                <tr>
                                    <td>Phòng / Ngày</td>
                                    <td>Thứ 2 <br> <span>{{ date("d/m/Y", strtotime($dates[0])) }}</span></td>
                                    <td>Thứ 3 <br> <span>{{ date("d/m/Y", strtotime($dates[1])) }}</span></td>
                                    <td>Thứ 4 <br> <span>{{ date("d/m/Y", strtotime($dates[2])) }}</span></td>
                                    <td>Thứ 5 <br> <span>{{ date("d/m/Y", strtotime($dates[3])) }}</span></td>
                                    <td>Thứ 6 <br> <span>{{ date("d/m/Y", strtotime($dates[4])) }}</span></td>
                                    <td>Thứ 7 <br> <span>{{ date("d/m/Y", strtotime($dates[5])) }}</span></td>
                                    <td>Chủ nhật <br> <span>{{ date("d/m/Y", strtotime($dates[6])) }}</span></td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($rooms as $room)
                                    <tr align="center">

                                        <td>{{ $room->name }}</td>

                                        @for ($i = 0; $i<= 6; $i++)
                                            <td>

                                                @foreach ($schedules_1[$room->id][$i] as $value)
                                                    <strong>{{ date("H:i", strtotime($value->test_time)) }} - {{ date("H:i", strtotime($value->end_time)) }}</strong>
                                                    <br>{{ $value->meet_name }}<br>
                                                @endforeach
                                                
                                            </td>
                                        @endfor
 
                                    </tr>
                                @endforeach
                                
                                <tr align="center">
                                    <td>Phòng họp đơn vị</td>

                                    @for ($i=0;$i<=6;$i++)
                                        <td>
                                            @foreach ($schedules_2[$i] as $value)
                                                <strong>{{ date("H:i", strtotime($value->test_time)) }} - {{ date("H:i", strtotime($value->end_time)) }}</strong>
                                                <br>{{ $value->meet_name }}<br>
                                            @endforeach
                                        </td>     
                                    @endfor
                                    
                                </tr>

                                <tr align="center">
                                    <td>Jitsi Meet</td>

                                    @for ($i=0;$i<=6;$i++)
                                        <td>
                                            @foreach ($schedules_3[$i] as $value)
                                                <strong>{{ date("H:i", strtotime($value->test_time)) }} - {{ date("H:i", strtotime($value->end_time)) }}</strong>
                                                <br>{{ $value->meet_name }}<br>
                                            @endforeach
                                        </td>     
                                    @endfor
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>