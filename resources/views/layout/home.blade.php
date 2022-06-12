@extends('layout.master')

@section('title', 'Trang chủ')

@section('content')
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
@endsection

@section('script')
    <script>
        $('#home').addClass('active');
    </script>
@endsection