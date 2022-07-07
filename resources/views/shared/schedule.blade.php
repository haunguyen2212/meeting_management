@extends('layout.master')

@section('title', 'Lịch họp tuần')

@section('style')
    <link rel="stylesheet" href="./dist/css/schedule.css">
@endsection

@section('content')
    <div class="recent-grid grid-col-100">
        <div class="meeting-schedule">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="min-width: 1000px">
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
                <div>
                    <a class="btn btn-main ms-3 mb-3" href="{{ route('schedule.print') }}">Tải xuống</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('#schedule').addClass('active');
</script>
@endsection