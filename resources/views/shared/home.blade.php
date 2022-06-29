@extends('layout.master')

@section('title', 'Trang chủ')

@section('content')
    
        <div class="recent-grid grid-col-65">
            <div class="list-info">
                <div class="card">
                    <div class="card-header">
                        <h3>Thông tin cá nhân</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td rowspan="5" align="center">
                                            <img src="./dist/img/avatar/{{ $user->avatar }}" alt="" width="100px">
                                            <button class="btn btn-white btn-img" 
                                                    data-url="{{ route('avatar.edit', ['id' => $user->id]) }}"
                                                    data-update="{{ route('avatar.update', ['id' => $user->id]) }}"
                                                    onclick="showModal(event, '#changeImg')"
                                            >
                                                <span class="las la-camera"></span> Đổi ảnh
                                            </button>
                                        </td>
                                        <td><strong>Họ và tên CB: </strong>{{ $user->name }}</td>
                                        <td><strong>Giới tính: </strong>{{ ($user->sex == 0) ? 'Nam' : 'Nữ' }}</td>
                                        <td align="right">
                                            <button class="btn btn-main btn-change-pass" 
                                                    onclick="showModal(event, '#changePass')" 
                                                    data-url="{{ route('password.change') }}"
                                            >Đổi mật khẩu</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ngày sinh: </strong>{{ date("d/m/Y", strtotime($user->date_of_birth)) }}</td>
                                        <td colspan="2"><strong>Điện thoại: </strong>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Chức vụ: </strong>{{ $user->position_name }}</td>
                                        <td colspan="2"><strong>Đơn vị: </strong>{{ $user->department_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email: </strong>{{ $user->email }}</td>
                                        <td colspan="2"><strong>Địa chỉ: </strong>{{ $user->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tài khoản: </strong>{{ $user->username }}</td>
                                        <td colspan="2"><strong>Vai trò: </strong>{{ $user->role_name }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="center">
                                            <button class="btn btn-main btn-edit" 
                                                    data-url="{{ route('profile.edit', ['id' => $user->id]) }}" 
                                                    data-update="{{ route('profile.update', ['id' => $user->id]) }}"
                                                    onclick="showModal(event, '#editInfo')"
                                            >Cập nhật thông tin</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-message">
                <div class="card">
                    <div class="card-header">
                        <h3>Thông báo</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($notifies as $notify)
                            @if ($notify->status == 1 && !empty($notify->supporter_name))
                                <div class="alert alert-primary">
                                    Cuộc họp "{{ $notify->meet_name }}" của bạn đã bộ phận quản lý phân công cán bộ <a class="text-danger" href="{{ route('supporter.info', ['id' => $notify->supporter_id]) }}">{{ $notify->supporter_name }}</a> hỗ trợ.<br>
                                    <small>{{ \Carbon\Carbon::parse($notify->assignment_time)->diffForHumans() }}</small>
                                </div>
                            @endif
                            @if ($notify->status == 1)
                                <div class="alert alert-success">
                                    Yêu cầu đăng ký "{{ $notify->meet_name }}" của bạn đã được chấp thuận.<br>
                                    <small>{{ \Carbon\Carbon::parse($notify->approval_time)->diffForHumans() }}</small>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    Yêu cầu đăng ký "{{ $notify->meet_name }}" của bạn đã bị từ chối.<br>
                                    Phản hồi từ lãnh đạo: {{ $notify->feedback }} <br>
                                    <small>{{ \Carbon\Carbon::parse($notify->approval_time)->diffForHumans() }}</small>
                                </div>
                            @endif     
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @include('shared.modal.info')

@endsection

@section('script')
    <script src="./dist/js/home_ajax.js"></script>
    <script>
        $('#home').addClass('active');
    </script>
@endsection