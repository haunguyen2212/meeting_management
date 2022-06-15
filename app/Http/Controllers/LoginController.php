<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public static function getSessionUser(){
        if(Session::has('user')){
            Session::forget('user');
        }
        $username = Auth::user()->username;
        $user = Member::join('users', 'account_id', 'users.id')
            ->join('roles', 'role_id', 'roles.id')
            ->where('username', $username)
            ->select('username', 'members.name', 'avatar', 'role_id', DB::raw("roles.name as roleName"))
            ->first();
        Session::put('user', $user);
        return true;
    }

    public function index(){
        return view('layout.login');
    }

    public function check(Request $request){
        $username = $request->username;
        $password = $request->password;

        $rules = [
            'username' => 'required',
            'password' => 'required|max:20',
        ];

        $messages = [
            'username.required' => 'Chưa nhập tên tài khoản',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.max' => 'Mật khẩu vượt quá giới hạn',
        ];

        $request->validate($rules, $messages);

        if(Auth::attempt(['username' => $username, 'password' => $password])){
            $this->getSessionUser();
            return redirect()->route('home');
        }
        else{
            return redirect()->route('login')->withInput()->with('status','Tài khoản hoặc mật khẩu không chính xác');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
