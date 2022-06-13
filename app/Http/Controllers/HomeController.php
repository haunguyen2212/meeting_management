<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index(){
        if(Auth::user()->role_id == 1){
            $users = Member::join('accounts', 'account_id', 'accounts.id')
                ->select('users.name', 'avatar' , 'username')
                ->take(6)
                ->get();
        return view('shared.home', compact('users', $users));
        }
        else{
            $id = Member::where('account_id', Auth::id())->first()->id;
            $user = Member::join('accounts', 'account_id', 'accounts.id')
            ->join('roles', 'role_id', 'roles.id')
            ->join('departments', 'department_id', 'departments.id')
            ->join('positions', 'position_id', 'positions.id')
            ->where('users.id', $id)
            ->select('users.id','users.name', 'account_id', 'date_of_birth', 'sex', 'address' ,'avatar', 'phone', 'email' , 'username', DB::raw('departments.name as department_name, positions.name as position_name, roles.name as role_name'))
            ->first();
            return view('shared.home', compact('user', $user)); 
        }
    }

    public function changePassword(Request $request){
        $old_pass = Auth::user()->password;

        $rules = [
            'old_pass' => 'required',
            'new_pass' => 'required|min:8|max:20|different:old_pass|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/',
        ];

        $messages = [
            'old_pass.required' => 'Chưa nhập mật khẩu hiện tại',
            'new_pass.required' => 'Chưa nhập mật khẩu mới',
            'new_pass.min' => 'Mật khẩu ít nhất 8 kí tự',
            'new_pass.max' => 'Mật khẩu tối đa 20 kí tự',
            'new_pass.different' => 'Mật khẩu mới không được trùng với mật khẩu cũ',
            'new_pass.regex' => 'Mật khẩu phải có ít nhất 1 kí tự hoa, 1 kí tự thường và 1 số',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        if (Hash::check($request->old_pass, $old_pass)) {
            $change = User::find(Auth::id())->update([
                'password' => Hash::make($request->new_pass),
            ]);
    
            if ($change) {
                Toastr::success('Đổi mật khẩu thành công', 'Thành công');
                return response()->json(['status' => 1], 200);
            } else {
                Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
                return response()->json(['status' => 0]);
            }
        } else {
            $error['old_pass'] = ['Mật khẩu không trùng khớp'];
            return response()->json(['error' => $error,'status' => 0 ]);
        }
    }

    public function editProfile($id){
        $data = Member::select('id', 'name', 'date_of_birth', 'sex', 'address', 'phone', 'email')->find($id);
        return response()->json(['data' => $data, 'status' => 1], 200);
    }

    public function updateProfile($id, Request $request){
        
        $user = Member::find($id);
        $rules = [
            'name_edit' => 'required',
            'gender_edit' => 'required',
            'date_edit' => 'required',
            'phone_edit' => 'required',
            'address_edit' => 'required',
            'email_edit' => [
                'required',
                Rule::unique('users', 'email')->ignore($id, 'id'),
            ],
        ];

        $messages = [
            'name_edit.required' => 'Chưa nhập họ tên',
            'gender_edit.required' => 'Chưa chọn giới tính',
            'date_edit.required' => 'Chưa nhập ngày sinh',
            'phone_edit.required' => 'Chưa nhập số điện thoại',
            'address_edit.required' => 'Chưa nhập địa chỉ',
            'email_edit.required' => 'Chưa nhập email',
            'email_edit.unique' => 'Email đã tồn tại',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        $date_edit = date("Y-m-d", strtotime($request->date_edit));

        $update = $user->update([
            'name' => $request->name_edit,
            'sex' => $request->gender_edit,
            'date_of_birth' => $date_edit,
            'address' => $request->address_edit,
            'phone' => $request->phone_edit,
            'email' => $request->email_edit,
        ]);


        if($update){
            Toastr::success('Cập nhật thông tin thành công', 'Thành công');
            return response()->json(['status' => 1], 200);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }
        
}
