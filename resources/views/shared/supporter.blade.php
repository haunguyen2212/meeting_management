@extends('layout.master')

@section('title', 'Thông tin cán bộ')

@section('content')
    <div class="recent-grid grid-col-65">
        <div class="list-info">
            <div class="card">
                <div class="card-header">
                    <h3>Thông tin cán bộ</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td rowspan="3" align="center">
                                        <img src="./dist/img/avatar/{{ $supporter->avatar }}" alt="" width="100px">
                                    </td>
                                    <td><strong>Họ và tên: </strong>{{ $supporter->name }}</td>
                                    <td><strong>Giới tính: </strong>{{ ($supporter->sex == 0) ? 'Nam' : 'Nữ' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày sinh: </strong>{{ date("d/m/Y", strtotime($supporter->date_of_birth)) }}</td>
                                    <td colspan="2"><strong>Điện thoại: </strong>{{ $supporter->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email: </strong>{{ $supporter->email }}</td>
                                    <td colspan="2"><strong>Địa chỉ: </strong>{{ $supporter->address }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-white text-primary"><i class="las la-undo-alt"></i> Trở lại</a>
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