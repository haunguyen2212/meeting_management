@extends('layout.master')

@section('title', 'Phê duyệt đăng ký')

@section('content')
    <div class="recent-grid grid-col-100">
        <div class="list-meeting">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách đăng ký</h3>
                    <form action="" method="get">
                        <span class="filter">
                            <span>Hiển thị:</span>
                            <select name="filter" onchange="this.form.submit();">
                                <option {{ request('filter') == 'new' ? 'selected' : '' }} value="new">Chờ phản hồi</option>
                                <option {{ request('filter') == 'accept' ? 'selected' : '' }} value="accept">Đã chấp nhận</option>
                                <option {{ request('filter') == 'deny' ? 'selected' : '' }} value="deny">Đã từ chối</option>
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
                                    <td width="5%">STT</td>
                                    <td width="15%">Tên cuộc họp</td>
                                    <td width="12.5%">Đơn vị đăng ký</td>
                                    <td width="10%">Loại</td>
                                    <td width="13%">Thời gian</td>
                                    <td width="12%">Phòng họp</td>
                                    <td width="12.5%">Văn bản</td>
                                    <td width="10%">Trạng thái</td>
                                    <td width="10%">Phê duyệt</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($meetings as $key => $meeting)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meet_name }}</td>
                                        <td>{{ $meeting->department_name }}</td>
                                        <td>{{ $meeting->type_name }}</td>
                                        <td>
                                            <strong>Thử nghiệm: </strong> <br> {{ date("H:i d/m/Y", strtotime($meeting->test_time)) }} <br>
                                            <strong>Chính thức: </strong> <br> {{ date("H:i d/m/Y", strtotime($meeting->start_time)) }} - 
                                            {{ date("H:i d/m/Y", strtotime($meeting->end_time)) }}
                                        </td>
                                        <td>{{ $meeting->room_name }}</td>
                                        <td>

                                            @if ($meeting->document != NULL)
                                                <a target="_blank" href="./dist/upload/{{ $meeting->document }}">{{ $meeting->document }}</a>
                                            @endif
                                            
                                        </td>
                                            
                                        @switch($meeting->status)
                                            @case('-1')
                                                <td class="text-danger">Đã từ chối</td>
                                                <td>
                                                    <button class="btn btn-success btn-accept" data-url="{{ route('approval.accept', ['id' => $meeting->id]) }}"><span class="las la-check"></span></button>
                                                </td>
                                                @break
                                            @case('0')
                                                <td class="text-secondary">Đang chờ phê duyệt</td>
                                                <td>
                                                    <button class="btn btn-success btn-accept" data-url="{{ route('approval.accept', ['id' => $meeting->id]) }}"><span class="las la-check"></span></button>
                                                    <button class="btn btn-danger btn-deny" onclick="showModal(event, '#sendFeedback')" data-url="{{ route('approval.deny', ['id' => $meeting->id]) }}"><span class="las la-times"></span></button>
                                                </td>
                                            @break
                                            @default
                                                <td class="text-success">Đã phê duyệt</td>
                                                <td>
                                                    <button class="btn btn-danger btn-deny" onclick="showModal(event, '#sendFeedback')" data-url="{{ route('approval.deny', ['id' => $meeting->id]) }}"><span class="las la-times"></span></button>
                                                </td>
                                        @endswitch
           
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
    @include('leader.modal.approval')
@endsection

@section('script')
    <script>
        $('#approval').addClass('active');
    </script>
    <script src="./dist/js/approval_ajax.js"></script>
@endsection