@extends('layout.master')

@section('title', 'Lịch hỗ trợ')

@section('content')
    <div class="recent-grid grid-col-100">
        <div class="room-management">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách cuộc họp</h3>
                    <form action="" method="get">
                        <span class="filter">
                            <span>Hiển thị:</span>
                            <select name="filter" onchange="this.form.submit();">
                                <option {{ request('filter') == 'new' ? 'selected' : '' }} value="now">Chưa hỗ trợ</option>
                                <option {{ request('filter') == 'all' ? 'selected' : '' }} value="all">Tất cả</option>
                            </select>
                        </span>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="min-width: 1000px">
                            <thead>
                                <tr>
                                    <td width="10%">STT</td>
                                    <td width="15%">Thời gian</td>
                                    <td width="25%">Tên cuộc họp</td>
                                    <td width="20%">Đơn vị</td>
                                    <td width="15%">Hình thức</td>
                                    <td width="15%">Phòng họp</td>              
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ date('H:i', strtotime($value->test_time)) }} - {{ date('H:i d/m/Y', strtotime($value->end_time)) }}</td>
                                        <td>{{ $value->meet_name }}</td>
                                        <td>{{ $value->department_name }}</td>
                                        <td>{{ $value->type_name }}</td>
                                        <td>{{ $value->room_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#support').addClass('active');
    </script> 
@endsection