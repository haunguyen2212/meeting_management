@extends('layout.master')

@section('title', 'Thông tin tài khoản')

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
                                            ><span class="las la-key"></span></button>
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

        </div>

        @include('shared.modal.info')

@endsection

@section('script')
    <script src="./dist/js/home_ajax.js"></script>
    <script>
        $('#profile').addClass('active');
    </script>
@endsection