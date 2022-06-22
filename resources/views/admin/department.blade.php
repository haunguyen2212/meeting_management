@extends('layout.master')

@section('title', 'Quản lý đơn vị')

@section('content')
    <div class="recent-grid grid-col-65">
        <div class="room-management">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách đơn vị</h3>
                    <button onclick="showModal(event, '#departmentAdd')">Thêm mới <span class="las la-plus"></span></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="min-width: 600px">
                            <thead>
                                <tr>
                                    <td width="10%">ID</td>
                                    <td width="45%">Tên đơn vị</td>
                                    <td width="15%">Thành viên</td>
                                    <td width="30%">Tùy chỉnh</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->id }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td align="center">{{ $department->number_member }}</td>
                                        <td>
                                            <button class="btn btn-info btn-show"
                                                data-url="{{ route('department.show', ['department' => $department->id]) }}"
                                                onclick="showModal(event, '#departmentShow')"    
                                            >Xem</button>
                                            <button class="btn btn-warning btn-edit"
                                                data-url="{{ route('department.edit', ['department' => $department->id]) }}"
                                                data-update="{{ route('department.update', ['department' => $department->id]) }}"
                                                onclick="showModal(event, '#departmentEdit')"
                                            >Sửa</button>
                                            <button class="btn btn-danger btn-delete"
                                                    data-url="{{ route('department.destroy', ['department' => $department->id]) }}"
                                            >Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $departments->links() }}
            </div>
        </div>  
    </div>
    @include('admin.modal.department')
@endsection

@section('script')
    <script>
        $('#department').addClass('active');
    </script>
    <script src="./dist/js/department_ajax.js"></script>
@endsection