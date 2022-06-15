@extends('layout.master')

@section('title', 'Trang chủ')

@section('content')
    {{-- @if (Auth::user()->role_id == 1)
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1>54</h1>
                    <span>Cuộc họp</span>
                </div>
                <div>
                    <span class="las la-video"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>15</h1>
                    <span>Phòng họp</span>
                </div>
                <div>
                    <span class="las la-warehouse"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>100</h1>
                    <span>Tài khoản</span>
                </div>
                <div>
                    <span class="las la-user"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>15</h1>
                    <span>Trực tuyến</span>
                </div>
                <div>
                    <span class="lab la-google-wallet"></span>
                </div>
            </div>
        </div>

        <div class="recent-grid grid-col-65">
            <div class="list-meeting">
                <div class="card">
                    <div class="card-header">
                        <h3>Danh sách cuộc họp</h3>
                        <button>Xem thêm <span class="las la-arrow-right"></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%" class="hidden-last-child">
                                <thead>
                                    <tr>
                                        <td width="20%">Phòng họp</td>
                                        <td width="40%">Đơn vị</td>
                                        <td width="20%">Thời gian</td>
                                        <td width="20%">Tình trạng</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Phòng họp 1</td>
                                        <td>Phòng Bưu chính, Viễn thông - Công nghệ thông tin</td>
                                        <td>06/08/2022 08:00:00</td>
                                        <td>
                                            <span class="status success"></span>
                                        Đang diễn ra
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phòng họp 2</td>
                                        <td>Phòng Thông tin - Báo Chí - Xuất bản</td>
                                        <td>06/08/2022 08:00:00</td>
                                        <td>
                                            <span class="status success"></span>
                                        Đang diễn ra
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phòng họp 3</td>
                                        <td>Ban giám đốc</td>
                                        <td>06/08/2022 08:00:00</td>
                                        <td>
                                            <span class="status primary"></span>
                                        Sắp diễn ra
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phòng họp 4</td>
                                        <td>Phòng kế toán</td>
                                        <td>06/08/2022 08:00:00</td>
                                        <td>
                                            <span class="status primary"></span>
                                        Sắp diễn ra
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phòng họp 5</td>
                                        <td>Ban giám đốc</td>
                                        <td>06/08/2022 08:00:00</td>
                                        <td>
                                            <span class="status danger"></span>
                                        Đã kết thúc
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phòng họp 6</td>
                                        <td>Phòng Thông tin - Báo Chí - Xuất bản</td>
                                        <td>06/08/2022 08:00:00</td>
                                        <td>
                                            <span class="status danger"></span>
                                        Đã kết thúc
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jitsi Meet</td>
                                        <td>Phòng Thông tin - Báo Chí - Xuất bản</td>
                                        <td>06/08/2022 08:00:00</td>
                                        <td>
                                            <span class="status danger"></span>
                                        Đã kết thúc
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-user">
                <div class="card">
                    <div class="card-header">
                        <h3>Thành viên</h3>
                        <button onclick="window.location.href='{{ route('account.index') }}'">Xem thêm <span class="las la-arrow-right"></span></button>
                    </div>
                    <div class="card-body">
                        
                        @foreach ($users as $user)
                            <div class="user">
                                <div class="info">
                                    <img src="./dist/img/avatar/{{ $user->avatar }}" width="40px" height="40px" alt="image">
                                    <div>
                                        <h4>{{ $user->name }}</h4>
                                        <small>{{ $user->username }}</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="las la-user-circle"></span>
                                    <span class="las la-comment"></span>
                                    <span class="las la-phone"></span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    @else --}}
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

                    </div>
                </div>
            </div>
        </div>

        @include('shared.modal.info')
    {{-- @endif --}}


@endsection

@section('script')
    <script src="./dist/js/home_ajax.js"></script>
    <script>
        $('#home').addClass('active');
    </script>
@endsection