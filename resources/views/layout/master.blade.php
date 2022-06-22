<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{asset('frontend')}}/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="./plugins/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="./dist/css/toastr.css">
    <link rel="stylesheet" href="./dist/css/style.css">
    @yield('style')
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-video"></span> <span>Meeting</span> </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a id="home" href="{{ route('home') }}"><span class="las la-home"></span><span>Trang chủ</span></a>
                </li>
                <li>
                    <a id="register" href="{{ route('register.index') }}"><span class="las la-phone-volume"></span><span>Đăng ký họp</span></a>
                </li>

                @if (Auth::user()->role_id == 1)
                    <li>
                        <a id="account" href="{{ route('account.index') }}"><span class="las la-user-circle"></span><span>Tài khoản</span></a>
                    </li>
                    <li>
                        <a id="room" href="{{ route('room.index') }}"><span class="las la-warehouse"></span><span>Phòng họp</span></a>
                    </li>
                    
                    <li>
                        <a id="department" href="{{ route('department.index') }}"><span class="las la-city"></span><span>Đơn vị</span></a>
                    </li>
                    <li>
                        <a id="meeting-list" href="{{ route('meeting.index') }}"><span class="las la-calendar-check"></span><span>Cuộc họp</span></a>
                    </li>
                    <li>
                        <a href=""><span class="las la-signal"></span><span>Thống kê</span></a>
                    </li>
                @endif
                
                @if (Auth::user()->role_id == 2)
                    <li>
                        <a id="approval" href="{{ route('approval.index') }}"><span class="las la-clipboard-list"></span><span>Phê duyệt đăng ký</span></a>
                    </li>
                @endif

                @if (Auth::user()->role_id == 3)
                    <li>
                        <a href=""><span class="las la-edit"></span><span>Phân công cán bộ</span></a>
                    </li>
                @endif

                <li>
                    <a id="schedule" href="{{ route('schedule.index') }}"><span class="las la-calendar"></span><span>Lịch họp</span></a>
                </li>
                <li>
                    <a id="document" href="{{ route('document.list') }}"><span class="las la-file-alt"></span><span>Biểu mẫu</span></a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><span class="las la-sign-out-alt"></span><span>Đăng xuất</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                <span>Dashboard</span> 
            </h2>
            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Tìm kiếm ...">
            </div>
            <div class="user-wrapper">
                <img src="./dist/img/avatar/{{ Session::get('user')->avatar }}" width="40px" height="40px" alt="avatar">
                <div>
                    <h4>{{ Session::get('user')->name }}</h4>
                    <small>{{ Session::get('user')->roleName }}</small>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="./plugins/jquery/jquery-3.6.0.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="./dist/js/function.js"></script>
    @yield('script')
</body>
</html>