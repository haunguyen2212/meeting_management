@extends('layout.master')

@section('title', 'Chức vụ')

@section('content')
    <div class="recent-grid grid-col-50">
        <div class="room-management">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách chức vụ</h3>
                    <button onclick="showModal(event, '#positionAdd')">Thêm mới <span class="las la-plus"></span></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td width="20%">STT</td>
                                    <td width="50%">Tên chức vụ</td>
                                    <td width="30%">Tùy chỉnh</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($positions as $key => $position)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $position->name }}</td>
                                        <td>
                                            <button class="btn btn-success btn-edit"
                                                data-url="{{ route('position.edit', ['position' => $position->id]) }}"
                                                data-update="{{ route('position.update', ['position' => $position->id]) }}"
                                                onclick="showModal(event, '#positionEdit')"
                                            >Sửa</button>
                                            <button class="btn btn-danger btn-delete"
                                                    data-url="{{ route('position.destroy', ['position' => $position->id]) }}"
                                                    onclick=""
                                            >Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $positions->links() }}
            </div>
        </div>  
    </div>
    @include('admin.modal.position')
@endsection

@section('script')
    <script>
        $('#position').addClass('active');
    </script>
    <script src="./dist/js/position_ajax.js"></script>
@endsection