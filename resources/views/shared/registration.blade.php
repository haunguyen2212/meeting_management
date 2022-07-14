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
                    <form action="{{ route('registration.store') }}" method="post" enctype="multipart/form-data">
                        <div class="form-container" style="margin-top: -15px">
                            <div class="form-control">
                                @csrf
                                <div class="input-box-100">
                                    <span class="input-label">Tên cuộc họp:</span>
                                    <input type="text" name="meet_name" value="{{ old('meet_name') }}" placeholder="Nhập tên cuộc họp">
                                    
                                    @error('meet_name')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror

                                </div>

                                @if (Auth::user()->role_id == 1)
                                    <div class="select-box-100">
                                        <span class="input-label">Đơn vị đăng ký:</span>
                                        <select id="department_name" name="department_name">
                                            <option value="">Chọn tên đơn vị</option>

                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{(old("department_name") == $department->id) ? "selected": ""}}>{{ $department->name }}</option>
                                            @endforeach

                                        </select>

                                        @error('department_name')
                                            <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                        @enderror

                                    </div>
                                @endif
                                <div class="select-box-50">
                                    <span class="input-label">Hình thức đăng ký:</span>
                                    <select id="type_sp" name="type_sp">
                                        <option value="">Chọn hình thức đăng ký</option>

                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{(old("type_sp") == $type->id) ? "selected": ""}}>{{ $type->name }}</option>
                                        @endforeach

                                    </select>

                                    @error('type_sp')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="select-box-50" disabled>
                                    <span class="input-label">Phòng họp:</span>
                                    <select id="room_name" name="room_name" disabled>
                                        <option value="">Chọn phòng họp:</option>

                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}" {{(old("room_name") == $room->id) ? "selected": ""}}>{{ $room->name }}</option>    
                                        @endforeach
                                        
                                    </select>

                                    @error('room_name')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror

                                    @if (session('status'))
                                        <div class="text-danger font-13 ms-2">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                </div>
                                <div class="input-box-50">
                                    <span class="input-label">Thời gian thử nghiệm:</span>
                                    <input type="text" name="test_time" id="test_time" value="{{ old('test_time') }}" placeholder="dd-mm-YY HH:mm" autocomplete="off">
                                    
                                    @error('test_time')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="input-box-50">
                                    <span class="input-label">Thời gian bắt đầu:</span>
                                    <input type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" placeholder="dd-mm-YY HH:mm" autocomplete="off">
                                    
                                    @error('start_time')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="input-box-50">
                                    <span class="input-label">Thời gian kết thúc:</span>
                                    <input type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" placeholder="dd-mm-YY HH:mm" autocomplete="off">
                                    
                                    @error('end_time')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="file-box-50">
                                    <span class="input-label">Văn bản:</span>
                                    <input type="file" name="document">
                                    
                                    @error('document')
                                        <div class="text-danger font-13 ms-2">{{ $message }}</div>
                                    @enderror

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
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td width="10%">STT</td>
                                    <td width="55%">Tên cuộc họp</td>
                                    <td width="35%">Chi tiết</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($history_registrations as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="
                                        @switch($value->status)
                                            @case(-1)
                                                text-danger
                                                @break
                                            @case(1)
                                                text-primary
                                            @break
                                        @endswitch
                                        ">
                                            {{ $value->meet_name }}
                                        </td>
                                        <td>
                                            <button class="btn btn-main btn-show"
                                                data-url="{{ route('registration.show', ['registration' => $value->id]) }}" 
                                                onclick="showModal(event, '#registrationShow')">
                                                <span class="las la-eye"></span>
                                            </button>
                                            @if ($value->status == 0)
                                                <button
                                                    data-url="{{ route('registration.destroy', ['registration' => $value->id]) }}"
                                                    class="btn btn-danger btn-cancel">
                                                    <span class="las la-times"></span>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $history_registrations->links() }}
            </div>
        </div>
    </div>
    @include('shared.modal.registration')
@endsection

@section('script')
    <script>
        $('#registration').addClass('active');
        $("#type_sp").change(function(){
            if($("#type_sp").children("option:selected").val() == 1){
                $('#room_name').prop('disabled', false);
            }
            else{
                $('#room_name').prop('disabled', 'disabled'); 
            }
        });
        
        @if (old('type_sp') == 1)
            $('#room_name').prop('disabled', false);
        @endif

    </script>
    <script src="./plugins/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
    <script>
        $('#test_time, #start_time, #end_time').datetimepicker({
            format: 'd-m-Y H:i',
            minDate: 0,
            step: 15
        });
    </script>
    <script src="./dist/js/registration_ajax.js"></script>
@endsection