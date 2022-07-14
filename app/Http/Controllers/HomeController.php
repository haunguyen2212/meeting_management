<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\RoomRegistration;
use App\Models\Supporter;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    public function checkGateEdit($user){
        if(!Gate::allows('edit-info', $user)){
            Toastr::error('Bạn không có quyền thực hiện thao tác này', 'Lỗi');
            return false;
        }
        return true;
    }

    public function index(){
        $id = Member::where('account_id', Auth::id())->first()->id;
        $user = Member::join('users', 'account_id', 'users.id')
            ->join('roles', 'role_id', 'roles.id')
            ->join('departments', 'department_id', 'departments.id')
            ->join('positions', 'position_id', 'positions.id')
            ->where('members.id', $id)
            ->select('members.id','members.name', 'account_id', 'date_of_birth', 'sex', 'address' ,'avatar', 'phone', 'email' , 'username', DB::raw('departments.name as department_name, positions.name as position_name, roles.name as role_name'))
            ->first();
        return view('shared.home', compact('user')); 
    }

    public function changePassword(Request $request){

        $rules = [
            'old_pass' => 'required|max:20|current_password',
            'new_pass' => 'required|min:8|max:20|different:old_pass|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/',
            'renew_pass' => 'same:new_pass',
        ];

        $messages = [
            'old_pass.required' => 'Chưa nhập mật khẩu hiện tại',
            'old_pass.max' => 'Mật khẩu quá dài',
            'old_pass.current_password' => 'Mật khẩu không chính xác',
            'new_pass.required' => 'Chưa nhập mật khẩu mới',
            'new_pass.min' => 'Mật khẩu ít nhất 8 kí tự',
            'new_pass.max' => 'Mật khẩu tối đa 20 kí tự',
            'new_pass.different' => 'Mật khẩu mới không được trùng với mật khẩu cũ',
            'new_pass.regex' => 'Mật khẩu phải có ít nhất 1 kí tự hoa, 1 kí tự thường và 1 số',
            'renew_pass.same' => 'Mật khẩu không trùng khớp',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }

        
        $change = User::find(Auth::id())->update([
            'password' => Hash::make($request->new_pass),
        ]);
    
        if ($change) {
            Toastr::success('Đổi mật khẩu thành công', 'Thành công');
            return response()->json(['status' => 1]);
        } else {
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }

    public function editProfile($id){
        $user = Member::find($id);

        if(!$this->checkGateEdit($user)){
            return response()->json(['status' => 0]);
        }

        $data = Member::select('id', 'name', 'date_of_birth', 'sex', 'address', 'phone', 'email')->find($id);
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Lỗi');
            return response()->json(['error' => ['Không tìm thấy dữ liệu'], 'status' => 0]);
        }
    }

    public function updateProfile($id, Request $request){
        $user = Member::find($id);

        if(!$this->checkGateEdit($user)){
            return response()->json(['status' => 0]);
        }

        $rules = [
            'name_edit' => 'required|max:50',
            'gender_edit' => 'required|in:0,1',
            'date_edit' => 'required|date_format:d-m-Y',
            'phone_edit' => 'required|max:10',
            'address_edit' => 'required|max:200',
            'email_edit' => [
                'required',
                'max:100',
                Rule::unique('members', 'email')->ignore($id, 'id'),
            ],
        ];

        $messages = [
            'name_edit.required' => 'Chưa nhập họ tên',
            'name_edit.max' => 'Họ tên quá dài',
            'gender_edit.required' => 'Chưa chọn giới tính',
            'gender_edit.in' => 'Giá trị không hợp lệ',
            'date_edit.required' => 'Chưa nhập ngày sinh',
            'date_edit.date_format' => 'Ngày chưa đúng định dạng',
            'phone_edit.required' => 'Chưa nhập số điện thoại',
            'phone_edit.max' => 'Số điện thoại quá dài',
            'address_edit.required' => 'Chưa nhập địa chỉ',
            'address_edit.max' => 'Địa chỉ quá dài',
            'email_edit.required' => 'Chưa nhập email',
            'email_edit.max' => 'Email quá dài',
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
            LoginController::getSessionUser();
            Toastr::success('Cập nhật thông tin thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }
    
    public function editAvatar($id){
        $user = Member::find($id);

        if(!$this->checkGateEdit($user)){
            return response()->json(['status' => 0]);
        }
        
        $data = Member::find($id)->avatar;
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau');
            return response()->json(['error' => ['Không tìm thấy dữ liệu'], 'status' => 0]);
        }
    }

    public function updateAvatar($id, Request $request){

        $rules = [
            'img' => 'required|image',
        ];

        $messages = [
            'img.required' => 'Chưa chọn hình ảnh',
            'img.image' => 'Avatar phải là file hình ảnh',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->toArray(), 'status' => 0]);
        }


        $image = $request->file('img');

        if($image){
            $user = Member::find($id);
            if(!$this->checkGateEdit($user)){
                return response()->json(['status' => 0]);
            }

            $new_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('frontend/dist/img/avatar/'), $new_name);

            $avatar_default = 'avt-default.jfif';
            $old_img = $user->avatar;
            if($old_img != $avatar_default){
                $destinationPath = public_path('frontend/dist/img/avatar/').$old_img;
                if(file_exists($destinationPath)){
                    unlink($destinationPath);
                }
            }
            
            $update = $user->update([
                'avatar' => $new_name,
            ]);

            if(!$update){
                Toastr::error('Có lỗi xảy ra thử lại sau', 'Thất bại');
                return response()->json(['status' => 0]);
            }
        }

        LoginController::getSessionUser();
        Toastr::success('Cập nhật thành công', 'Thành công');
        return response()->json(['status' => 1]);
    }

    public function listDocument(){
        return view('shared.document');
    }

    public function getInfoSupporter($id){
        $supporter = Supporter::join('users', 'user_id', '=', 'users.id')
            ->join('members', 'account_id', '=', 'users.id')
            ->where('supporters.id', $id)
            ->first();
        
        if(empty($supporter)){
            Toastr::warning('Không tìm thấy thông tin cán bộ', 'Cảnh báo');
            return redirect()->route('home');
        }
        
        return view('shared.supporter', compact('supporter'));
    }
}
