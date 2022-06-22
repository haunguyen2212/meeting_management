@extends('layout.master')

@section('title', 'Quản lý tài khoản')

@section('style')
    <link rel="stylesheet" href="./dist/css/account.css">
@endsection

@section('content')
    <div class="recent-grid grid-col-100">
        <div class="user-management">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách tài khoản</h3>
                    <button class="btn-add" data-url="{{ route('account.create') }}" onclick="showModal(event, '#accountAdd')">Thêm mới <span class="las la-plus"></span></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="min-width: 1000px">
                            <thead>
                                <tr>
                                    <td width="10%">Tài khoản</td>
                                    <td width="15%">Tên cán bộ</td>
                                    <td width="7.5%">Ngày sinh</td>
                                    <td width="25%">Địa chỉ</td>
                                    <td width="10%">Điện thoại</td>
                                    <td width="15%">Email</td>
                                    <td width="17.5%">Tùy chỉnh</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($accounts as $account)
                                <tr>
                                    <td>{{ $account->username }}</td>
                                    <td>{{ $account->name }}</td>
                                    <td>{{ date("d/m/Y", strtotime($account->date_of_birth)) }}</td>
                                    <td>{{ $account->address }}</td>
                                    <td>{{ $account->phone }}</td>
                                    <td>{{ $account->email }}</td>
                                    <td>
                                        <button class="btn btn-info btn-show" 
                                                data-url="{{ route('account.show', ['account' => $account->id]) }}" 
                                                onclick="showModal(event, '#accountShow')"
                                        ><i class="las la-eye" style="font-size: .9rem"></i></button>
                                        <button class="btn btn-warning btn-edit" 
                                                data-url="{{ route('account.edit', ['account' => $account->id ]) }}" 
                                                data-update="{{ route('account.update', ['account' => $account->id]) }}" 
                                                onclick="showModal(event, '#accountEdit')"
                                        ><i class="las la-edit" style="font-size: .9rem"></i></button>
                                        <button class="btn btn-danger btn-delete" 
                                                data-url="{{ route('account.destroy', ['account' => $account->id]) }}"
                                        ><i class="las la-times" style="font-size: .9rem"></i></button>
                                        <button class="btn btn-success btn-change-pass"
                                                data-url="{{ route('account.password', ['id' => $account->account_id]) }}"
                                                onclick="showModal(event,'#passwordChange')"
                                        ><i class="las la-key" style="font-size: .9rem"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $accounts->links() }}
            </div>
        </div> 
    </div>
    @include('admin.modal.account')
@endsection

@section('script')
    <script>
        $('#account').addClass('active');
    </script>
    <script src="./dist/js/account_ajax.js"></script>
@endsection