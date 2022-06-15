<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Member;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    
    public function index()
    {
        $accounts = Member::join('users', 'account_id', 'users.id')
                ->select('members.id', 'username', 'members.name', 'account_id', 'date_of_birth', 'address', 'phone', 'email')
                ->paginate(8);
        return view('admin.account', compact('accounts', $accounts));
    }

    public function create()
    {
        $data = [];
        $data['positions'] = Position::select('id', 'name')->get();
        $data['roles'] = Role::select('id', 'name')->get();
        $data['departments'] = Department::select('id', 'name')->get();
        return response()->json(['data' => $data, 'status' => 1], 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'name_add' => 'required',
            'gender_add' => 'required',
            'date_add' => 'required|date_format:d-m-Y',
            'phone_add' => 'required',
            'address_add' => 'required',
            'department_add' => 'required',
            'position_add' => 'required',
            'email_add' => 'required|email|unique:members,email',
            'role_add' => 'required',
            'username_add' => 'required|unique:users,username',
            'password_add' => 'required|min:5|max:20',
        ];

        $messages = [
            'name_add.required' => 'Chưa nhập họ tên',
            'gender_add.required' => 'Chưa chọn giới tính',
            'date_add.required' => 'Chưa nhập ngày sinh',
            'date_add.date_format' => 'Ngày chưa đúng định dạng',
            'phone_add.required' => 'Chưa nhập số điện thoại',
            'address_add.required' => 'Chưa nhập địa chỉ',
            'department_add.required' => 'Chưa chọn đơn vị',
            'position_add.required' => 'Chưa chọn chức vụ',
            'email_add.required' => 'Chưa nhập email',
            'email_add.email' => 'Email không đúng',
            'email_add.unique' => 'Email đã tồn tại',
            'role_add.required' => 'Chưa chọn loại tài khoản',
            'username_add.required' => 'Chưa nhập tên tài khoản',
            'username_add.unique' => 'Tài khoản đã tồn tại',
            'password_add.required' => 'Chưa nhập mật khẩu',
            'password_add.min' => 'Mật khẩu ít nhất 5 kí tự',
            'password_add.max' => 'Mật khẩu tối đa 20 kí tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $date_add = date("Y-m-d", strtotime($request->date_add));

        $account = User::create([
            'username' => $request->username_add,
            'password' => Hash::make($request->password_add),
            'role_id' => $request->role_add,
        ]);

        $user = Member::create([
            'name' => $request->name_add,
            'department_id' => $request->department_add,
            'position_id' => $request->position_add,
            'account_id' => $account->id,
            'date_of_birth' => $date_add,
            'sex' => $request->gender_add,
            'address' => $request->address_add,
            'phone' => $request->phone_add,
            'email' => $request->email_add,
        ]);

        if($account && $user){
            Toastr::success('Thêm thành viên thành công', 'Thành công');
            return response()->json(['status' => 1], 200);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }   

    }

    public function show($id)
    {
        $data = Member::join('users', 'account_id', 'users.id')
                ->join('roles', 'role_id', 'roles.id')
                ->join('positions', 'position_id', 'positions.id')
                ->join('departments', 'department_id', 'departments.id')
                ->where('members.id', $id)
                ->select('members.id', 'members.name', 'date_of_birth', 'sex', 'address', 'avatar', 'phone', 'email', 'username', DB::raw("roles.name as role_name, departments.name as department_name, positions.name as position_name"))
                ->first();
        return response()->json(['data' => $data, 'status' => 1], 200);
    }

    public function edit($id)
    {
        $data = [];
        $data['user'] = Member::join('users', 'account_id', 'users.id')
                        ->where('members.id', $id)
                        ->select('members.id', 'name', 'department_id', 'position_id', 'username', 'role_id', 'date_of_birth', 'sex', 'address', 'avatar', 'phone', 'email')
                        ->first();
        $data['positions'] = Position::select('id', 'name')->get();
        $data['roles'] = Role::select('id', 'name')->get();
        $data['departments'] = Department::select('id', 'name')->get();
        return response()->json(['data' => $data, 'status' => 1], 200);
    }

    public function update(Request $request, $id)
    {
        $user = Member::find($id);
        $account_id = $user->account_id;
        $email = $user->email;
        $account = User::find($account_id);
        
        $rules = [
            'name_edit' => 'required',
            'gender_edit' => 'required',
            'date_edit' => 'required|date_format:d-m-Y',
            'phone_edit' => 'required',
            'address_edit' => 'required',
            'department_edit' => 'required',
            'position_edit' => 'required',
            'email_edit' => [
                'required',
                Rule::unique('members', 'email')->ignore($id, 'id'),
            ],
            'role_edit' => 'required',
            'username_edit' => [
                'required',
                Rule::unique('users', 'username')->ignore($account_id, 'id'),
            ],
        ];

        $messages = [
            'name_edit.required' => 'Chưa nhập họ tên',
            'gender_edit.required' => 'Chưa chọn giới tính',
            'date_edit.required' => 'Chưa nhập ngày sinh',
            'date_edit.date_format' => 'Ngày chưa đúng định dạng',
            'phone_edit.required' => 'Chưa nhập số điện thoại',
            'address_edit.required' => 'Chưa nhập địa chỉ',
            'department_edit.required' => 'Chưa chọn đơn vị',
            'position_edit.required' => 'Chưa chọn chức vụ',
            'email_edit.required' => 'Chưa nhập email',
            'email_edit.unique' => 'Email đã tồn tại',
            'role_edit.required' => 'Chưa chọn loại tài khoản',
            'username_edit.required' => 'Chưa nhập tên tài khoản',
            'username_edit.unique' => 'Tài khoản đã tồn tại',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $date_edit = date("Y-m-d", strtotime($request->date_edit));

        $update1 = $user->update([
            'name' => $request->name_edit,
            'sex' => $request->gender_edit,
            'department_id' => $request->department_edit,
            'position_id' => $request->position_edit,
            'date_of_birth' => $date_edit,
            'address' => $request->address_edit,
            'phone' => $request->phone_edit,
            'email' => $request->email_edit,
        ]);

        $update2 = $account->update([
            'username' => $request->username_edit,
            'role_id' => $request->role_edit,
        ]);

        if($update1 && $update2){
            Toastr::success('Cập nhật thông tin thành công', 'Thành công');
            return response()->json(['status' => 1], 200);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function destroy($id)
    {
        $user = Member::find($id);

        $avatar_default = 'avt-default.jfif';
        $account_id = $user->account_id;
        $avatar = $user->avatar;

        $delete = $user->delete();

        if($avatar != $avatar_default){
            $destinationPath = public_path('frontend/dist/img/avatar/').$avatar;
            if(file_exists($destinationPath)){
                unlink($destinationPath);
            }
        }
        
        $account = User::find($account_id)->delete();
        if($delete && $account){
            Toastr::success('Xóa người dùng thành công', 'Thành công');
            return response()->json(['status' => 1], 200);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
        
    }
}
