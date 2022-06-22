@extends('layout.master')

@section('title', 'Quản lý cuộc họp')

@section('content')
    <div class="recent-grid grid-col-100">
        <div class="meeting-management">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách cuộc họp</h3>
                    <form action="" method="get">
                        <span class="filter">
                            <span>Hiển thị:</span>
                            <select name="filter" onchange="this.form.submit();">
                                <option {{ request('filter') == 'all' ? 'selected' : '' }} value="all">Tất cả</option>
                                <option {{ request('filter') == 'now' ? 'selected' : '' }} value="now">Hôm nay</option>
                                <option {{ request('filter') == 'new' ? 'selected' : '' }} value="new">Chưa diễn ra</option>
                                <option {{ request('filter') == '3' ? 'selected' : '' }} value="3">3 ngày qua</option>
                                <option {{ request('filter') == '7' ? 'selected' : '' }} value="7">7 ngày qua</option>
                                <option {{ request('filter') == '30' ? 'selected' : '' }} value="30">30 ngày qua</option>
                            </select>
                        </span>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="min-width: 1000px">
                            <thead>
                                <tr>
                                    <td width="5%">STT</td>
                                    <td width="15%">Tên cuộc họp</td>
                                    <td width="10%">Thời gian</td>
                                    <td width="15%">Đơn vị</td>
                                    <td width="10%">Phòng họp</td>
                                    <td width="10%">Loại hỗ trợ</td>
                                    <td width="15%">Người hỗ trợ</td>
                                    <td width="10%">Trạng thái</td>
                                    <td width="10%">Tùy chỉnh</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($meetings as $key => $meeting)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meet_name }}</td>
                                        <td>{{ substr($meeting->test_time, 11, 5) }} - {{ date("H:i d/m/Y", strtotime($meeting->end_time)) }}</td>
                                        <td>{{ $meeting->department_name }}</td>
                                        <td>{{ $meeting->room_name ?? 'Jitsi Meet' }}</td>
                                        <td>{{ $meeting->type_name }}</td>
                                        <td>{{ $meeting->supporter_name }}</td>
                                        
                                            @switch($meeting->status)
                                            @case('-1')
                                                <td class="text-danger">Bị từ chối</td>
                                                @break
                                            @case('0')
                                                <td class="text-secondary">Chờ duyệt</td>
                                                @break
                                            @default
                                                <td class="text-primary">Đã duyệt</td>
                                            @endswitch
                                       
                                        <td>
                                            <button class="btn btn-main btn-show"
                                                    data-url="{{ route('meeting.show', ['id' => $meeting->id]) }}"
                                                    onclick="showModal(event, '#meetingShow')"
                                            >Chi tiết</button>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $meetings->links() }}
            </div>
        </div> 
    </div>
    @include('admin.modal.meeting')

@endsection

@section('script')
    <script>
        $('#meeting-list').addClass('active');
    </script>
    <script src="./dist/js/meeting_ajax.js"></script>
@endsection