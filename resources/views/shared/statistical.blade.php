@extends('layout.master')

@section('title', 'Trang chủ')

@section('style')
    <link rel="stylesheet" href="./dist/css/jquery-ui.css">
@endsection

@section('content')
    <div class="cards">
        <div class="card-single">
            <div>
                <h1>{{ (($num_registration > 0 && $num_registration < 10) ? '0'.$num_registration : $num_registration) }}</h1>
                <span>Đăng ký</span>
            </div>
            <div>
                <span class="las la-video"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ (($num_accept > 0 && $num_accept < 10) ? '0'.$num_accept : $num_accept) }}</h1>
                <span>Được chấp nhận</span>
            </div>
            <div>
                <span class="las la-check-square"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ (($num_deny > 0 && $num_deny < 10) ? '0'.$num_deny : $num_deny) }}</h1>
                <span>Bị từ chối</span>
            </div>
            <div>
                <span class="las la-times-circle"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ (($num_pending > 0 && $num_pending < 10) ? '0'.$num_pending : $num_pending) }}</h1>
                <span>Đang chờ duyệt</span>
            </div>
            <div>
                <span class="las la-hourglass"></span>
            </div>
        </div>
    </div>

    <div class="recent-grid grid-col-65">
        <div class="chart-statistical">
            <div class="list-message">
                <div class="card">
                    <div class="card-header">
                        <h3>Thông báo</h3>
                    </div>
                    <div class="card-body" style="padding-top: 0">
                            
                        @if ($notifies->count() > 0)
                            <h5 class="mt-3">Kết quả đăng ký:</h5>
                            @foreach ($notifies as $notify)
                                @if ($notify->status == 1)
                                    <div class="alert alert-success">
                                        Yêu cầu đăng ký <strong>"{{ $notify->meet_name }}"</strong> của bạn đã được chấp thuận.<br>
                                        <small>{{ \Carbon\Carbon::parse($notify->approval_time)->diffForHumans() }}</small>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        Yêu cầu đăng ký <strong>"{{ $notify->meet_name }}"</strong> của bạn đã bị từ chối.<br>
                                        Phản hồi: {{ $notify->feedback }} <br>
                                        <small>{{ \Carbon\Carbon::parse($notify->approval_time)->diffForHumans() }}</small>
                                    </div>
                                @endif     
                            @endforeach
                        @endif

                        @if ($assignments->count() > 0)
                            <h5 class="mt-3">Kết quả phân công:</h5>
                            @foreach ($assignments as $assignment)
                                <div class="alert alert-primary">
                                    <strong>"{{ $assignment->meet_name }}"</strong> đã được phân công cán bộ <a class="text-danger" href="{{ route('supporter.info', ['id' => $assignment->supporter_id]) }}"><strong>{{ $assignment->supporter_name }}</strong></a> hỗ trợ.<br>
                                    Thời gian: {{ date("H:i d/m/Y", strtotime($assignment->test_time)) }} - {{ date("H:i d/m/Y", strtotime($assignment->end_time)) }} <br>
                                    <small>{{ \Carbon\Carbon::parse($assignment->assignment_time)->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="list-statistical">
            <div class="card">
                <div class="card-header">
                    <h3>Thống kê chi tiết</h3>
                </div>
                <div class="card-body">
                    <ul style="font-size: 13px">
                        <li>Số cuộc họp: <b>{{ $num_accept }}</b>
                            <ul> 
                                @foreach ($types as $type)
                                    <li class="ps-3">- {{ $type->name }}: <b>{{ $num_type_meeting[$type->id] }}</b></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    
                    <form action="" method="get">
                        <div class="form-container" style="margin-top: -15px">
                            <div class="form-control">
                                <div class="input-box-100" style="margin-bottom: -5px">
                                    <span class="input-label">Chọn khoảng thời gian:</span>
                                </div>
                                <div class="input-box-50">
                                    <span class="input-label"></span>
                                    <input type="text" name="start" id="start" placeholder="Từ ngày" value="{{ old('start') }}" autocomplete="off">
                                    
                                    @error('start')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror
        
                                </div>
                                <div class="input-box-50">
                                    <span class="input-label"></span>
                                    <input type="text" name="end" id="end" placeholder="Đến ngày" value="{{ old('end') }}" autocomplete="off">
                                    
                                    @error('end')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror
        
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-main" style="margin-top: -20px"><span class="las la-filter"></span> Lọc kết quả</button>
                        </div>
                       
                    </form>
                </div>
            </div>
            
        </div>

    </div>
@endsection

@section('script')
    <script src="./dist/js/jquery-ui.min.js"></script>
    <script>
        $('#home').addClass('active');
    </script>
    <script>
        $('#start, #end').datepicker({
            dateFormat:"dd-mm-yy",
        });
    </script>
@endsection