@extends('layout.master')

@section('title', 'Đăng ký họp')

@section('style')
    <link rel="stylesheet" href="./plugins/datetimepicker-master/build/jquery.datetimepicker.min.css">
@endsection

@section('content')
    <div class="recent-grid grid-col-65">
        <div class="meeting-registration">
            <div class="card">
                <div class="card-header">
                    <h3>Đăng ký họp</h3>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-container" style="margin-top: -15px">
                            <div class="form-control">
                                <div class="input-box-100">
                                    <span class="input-label">Tên cuộc họp:</span>
                                    <input type="text" name="meet_name" placeholder="Nhập tên cuộc họp">
                                </div>
                                <div class="select-box-50">
                                    <span class="input-label">Hình thức đăng ký:</span>
                                    <select id="type_sp" name="type_sp">
                                        <option value="">Chọn hình thức đăng ký</option>

                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="select-box-50">
                                    <span class="input-label">Đơn vị đăng ký:</span>
                                    <select name="department_name">
                                        <option value="">Chọn tên đơn vị đăng ký</option>

                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="select-box-50" style="display: none">
                                    <span class="input-label">Phòng họp:</span>
                                    <select id="room_name" name="room_name" disabled>
                                        <option value="">Chọn phòng họp:</option>

                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>    
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="input-box-50">
                                    <span class="input-label">Thời gian thử nghiệm:</span>
                                    <input type="text" name="test_time" id="test_time" placeholder="dd-mm-YY HH:mm" autocomplete="off">
                                </div>
                                <div class="input-box-50">
                                    <span class="input-label">Thời gian bắt đầu:</span>
                                    <input type="text" name="start_time" id="start_time" placeholder="dd-mm-YY HH:mm" autocomplete="off">
                                </div>
                                <div class="input-box-50">
                                    <span class="input-label">Thời gian kết thúc:</span>
                                    <input type="text" name="end_time" id="end_time" placeholder="dd-mm-YY HH:mm" autocomplete="off">
                                </div>
                                <div class="file-box-50">
                                    <span class="input-label">Văn bản:</span>
                                    <input type="file" name="doccument">
                                </div>
                            </div>
                            <button class="btn btn-main" type="submit">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="list-message">
            <div class="card">
                <div class="card-header">
                    <h3>Lịch sử đăng ký</h3>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#register').addClass('active');
        $("#type_sp").change(function(){
            if($("#type_sp").children("option:selected").val() == 1){
                $('#room_name').prop('disabled', false);
                $('#room_name').parent().show();
            }
            else{
                $('#room_name').prop('disabled', 'disabled'); 
                $('#room_name').parent().hide();
            }
        });
        
    </script>
    <script src="./plugins/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
    <script>
        $('#test_time, #start_time, #end_time').datetimepicker({
            format: 'd-m-Y H:i',
            minDate: 0,
            minTime: 0,
            step: 15
        });
    </script>
@endsection