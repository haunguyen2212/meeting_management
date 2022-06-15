@extends('layout.master')

@section('title', 'Phòng họp')

@section('content')
    <div class="recent-grid grid-col-50">
        <div class="room-management">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách phòng họp</h3>
                    <button onclick="showModal(event, '#roomAdd')">Thêm mới <span class="las la-plus"></span></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td width="20%">ID</td>
                                    <td width="50%">Tên phòng</td>
                                    <td width="30%">Tùy chỉnh</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>
                                            <button class="btn btn-success btn-edit"
                                                data-url="{{ route('room.edit', ['room' => $room->id]) }}"
                                                data-update="{{ route('room.update', ['room' => $room->id]) }}"
                                                onclick="showModal(event, '#roomEdit')"
                                            >Sửa</button>
                                            <button class="btn btn-danger btn-delete"
                                                    data-url="{{ route('room.destroy', ['room' => $room->id]) }}"
                                                    onclick=""
                                            >Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $rooms->links() }}
            </div>
        </div>  
    </div>
    @include('admin.modal.room')
@endsection

@section('script')
    <script>
        $('#room').addClass('active');
    </script>
    <script src="./dist/js/room_ajax.js"></script>
@endsection