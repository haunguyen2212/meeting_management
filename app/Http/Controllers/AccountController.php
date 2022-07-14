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
                ->paginate(10);
        return view('admin.account', compact('accounts'));
    }

    public function create()
    {
        $data = [];
        $data['positions'] = Position::select('id', 'name')->get();
        $data['roles'] = Role::select('id', 'name')->orderBy('id', 'desc')->get();
        $data['departments'] = Department::select('id', 'name')->get();

        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'name_add' => 'required|max:50',
            'gender_add' => 'required|in:0,1',
            'date_add' => 'required|date_format:d-m-Y',
            'phone_add' => 'required|max:10',
            'address_add' => 'required|max:200',
            'department_add' => 'required|exists:departments,id',
            'position_add' => 'required|exists:positions,id',
            'email_add' => 'required|email|max:100|unique:members,email',
            'role_add' => 'required|exists:roles,id',
            'username_add' => 'required|min:5|max:20|unique:users,username',
            'password_add' => 'required|min:8|max:20',
        ];

        $messages = [
            'name_add.required' => 'Chưa nhập họ tên',
            'name_add.max' => 'Họ tên quá dài',
            'gender_add.required' => 'Chưa chọn giới tính',
            'gender_add.in' => 'Giá trị không hợp lệ',
            'date_add.required' => 'Chưa nhập ngày sinh',
            'date_add.date_format' => 'Ngày chưa đúng định dạng',
            'phone_add.required' => 'Chưa nhập số điện thoại',
            'phone_add.max' => 'Số điện thoại quá dài',
            'address_add.required' => 'Chưa nhập địa chỉ',
            'address_add.max' => 'Địa chỉ quá dài',
            'department_add.required' => 'Chưa chọn đơn vị',
            'department_add.exists' => 'Đơn vị không tồn tại',
            'position_add.required' => 'Chưa chọn chức vụ',
            'position_add.exists' => 'Chức vụ không tồn tại',
            'email_add.required' => 'Chưa nhập email',
            'email_add.email' => 'Email không đúng',
            'email_add.max' => 'Email quá dài',
            'email_add.unique' => 'Email đã tồn tại',
            'role_add.required' => 'Chưa chọn loại tài khoản',
            'role_add.exists' => 'Vai trò không tồn tại',
            'username_add.required' => 'Chưa nhập tên tài khoản',
            'username_add.min' => 'Tên tài khoản ít nhất 5 kí tự',
            'username_add.max' => 'Tên tài khoản không quá 20 kí tự',
            'username_add.unique' => 'Tài khoản đã tồn tại',
            'password_add.required' => 'Chưa nhập mật khẩu',
            'password_add.min' => 'Mật khẩu ít nhất 8 kí tự',
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
            return response()->json(['status' => 1]);
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
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function edit($id)
    {
        $data['user'] = Member::join('users', 'account_id', 'users.id')
                        ->where('members.id', $id)
                        ->select('members.id', 'name', 'department_id', 'position_id', 'username', 'role_id', 'date_of_birth', 'sex', 'address', 'avatar', 'phone', 'email')
                        ->first();
        $data['positions'] = Position::select('id', 'name')->get();
        $data['roles'] = Role::select('id', 'name')->get();
        $data['departments'] = Department::select('id', 'name')->get();

        if(!empty($data['user'])){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Member::find($id);
        $account_id = $user->account_id;
        $email = $user->email;
        $account = User::find($account_id);
        
        $rules = [
            'name_edit' => 'required|max:50',
            'gender_edit' => 'required|in:0,1',
            'date_edit' => 'required|date_format:d-m-Y',
            'phone_edit' => 'required|max:10',
            'address_edit' => 'required|max:200',
            'department_edit' => 'required|exists:departments,id',
            'position_edit' => 'required|exists:positions,id',
            'email_edit' => [
                'required',
                'max:100',
                Rule::unique('members', 'email')->ignore($id, 'id'),
            ],
            'role_edit' => 'required|exists:roles,id',
            'username_edit' => [
                'required',
                'min:5',
                'max:20',
                Rule::unique('users', 'username')->ignore($account_id, 'id'),
            ],
        ];

        $messages = [
            'name_edit.required' => 'Chưa nhập họ tên',
            'name_edit.max' => 'Tên quá dài',
            'gender_edit.required' => 'Chưa chọn giới tính',
            'gender_edit.in' => 'Giá trị không hợp lệ',
            'date_edit.required' => 'Chưa nhập ngày sinh',
            'date_edit.date_format' => 'Ngày chưa đúng định dạng',
            'phone_edit.required' => 'Chưa nhập số điện thoại',
            'phone_edit.max' => 'Số điện thoại quá dài',
            'address_edit.required' => 'Chưa nhập địa chỉ',
            'address_edit.max' => 'Địa chỉ quá dài',
            'department_edit.required' => 'Chưa chọn đơn vị',
            'department_edit.exists' => 'Đơn vị không tồn tại',
            'position_edit.required' => 'Chưa chọn chức vụ',
            'position_edit.exists' => 'Chức vụ không tồn tại',
            'email_edit.required' => 'Chưa nhập email',
            'email_edit.max' => 'Email quá dài',
            'email_edit.unique' => 'Email đã tồn tại',
            'role_edit.required' => 'Chưa chọn loại tài khoản',
            'role_edit.exists' => 'Loại tài khoản không tồn tại',
            'username_edit.required' => 'Chưa nhập tên tài khoản',
            'username_edit.min' => 'Tên tài khoản ít nhất 5 kí tự',
            'username_edit.max' => 'Tên tài khoản tối đa 20 kí tự',
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
            return response()->json(['status' => 1]);
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
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
        
    }

    public function changePassword($id, Request $request){
        $rules = [
            'password' => 'required|min:8|max:20',
        ];

        $messages = [
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu ít nhất 8 kí tự',
            'password.max' => 'Mật khẩu tối đa 20 kí tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $account = User::find($id);
        $password = $request->password;
        $update = $account->update([
            'password' => Hash::make($password),
        ]);
        if($update){
            Toastr::success('Thay đổi mật khẩu thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }
}
