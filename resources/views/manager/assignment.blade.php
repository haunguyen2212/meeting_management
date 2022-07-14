@extends('layout.master')

@section('title', 'Phân công cán bộ hỗ trợ')

@section('content')
    <div class="recent-grid grid-col-65">
        <div class="list-assignment">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách chờ phân công hỗ trợ</h3>
                    <form action="" method="get">
                        <span class="filter">
                            <span>Hiển thị:</span>
                            <select name="filter" onchange="this.form.submit();">
                                <option {{ request('filter') == 'new' ? 'selected' : '' }} value="new">Chờ phân công</option>
                                <option {{ request('filter') == 'done' ? 'selected' : '' }} value="done">Đã phân công</option>
                                <option {{ request('filter') == 'all' ? 'selected' : '' }} value="all">Tất cả</option>
                            </select>
                        </span>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="min-width: 600px">
                            <thead>
                                <tr>
                                    <td width="5%">STT</td>
                                    <td width="20%">Tên cuộc họp</td>
                                    <td width="20%">Đơn vị đăng ký</td>
                                    <td width="22.5%">Thời gian</td>
                                    <td width="17.5%">Cán bộ hỗ trợ</td>
                                    <td width="15%" align="center">Phân công</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($meetings as $key => $meeting)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meet_name }}</td>
                                        <td>{{ $meeting->department_name }}</td>
                                        <td>
                                            <strong>Thử nghiệm: </strong> <br> {{ date("H:i d/m/Y", strtotime($meeting->test_time)) }} <br>
                                            <strong>Chính thức: </strong> <br> {{ date("H:i d/m/Y", strtotime($meeting->start_time)) }} - 
                                            {{ date("H:i d/m/Y", strtotime($meeting->end_time)) }}
                                        </td>
                                        <td>{{ $meeting->supporter_name ?? 'Chưa phân công' }}</td>
                                        <td align="center">
                                            <button class="btn btn-main btn-assignment"
                                                data-url="{{ route('assignment.edit', ['assignment' => $meeting->id]) }}"
                                                data-assignment="{{ route('assignment.update', ['assignment'=> $meeting->id]) }}"
                                                onclick="showModal(event, '#assignmentStaff')"
                                            ><span class="las la-edit"></span></button>
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
        <div class="list-supporter">
            <div class="card">
                <div class="card-header">
                    <h3>Cán bộ hỗ trợ</h3>
                    <button 
                    class="btn-add"
                    onclick="showModal(event, '#addSupporter')"
                    data-url="{{ route('supporter.create') }}"
                    >Thêm <span class="las la-plus"></span></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <td width="15%">STT</td>
                                    <td width="70%">Tên cán bộ</td>
                                    <td width="15%" align="center">Xóa</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($supporters as $key => $supporter)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $supporter->name }}</td>
                                        <td align="center">
                                            <button class="btn btn-danger btn-hide"
                                                data-url="{{ route('supporter.hide', ['id' => $supporter->id]) }}"
                                            >
                                                <span class="las la-times"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manager.modal.assignment')
@endsection

@section('script')
    <script>
        $('#assignment').addClass('active');
    </script>
    <script src="./dist/js/assignment_ajax.js"></script>
@endsection