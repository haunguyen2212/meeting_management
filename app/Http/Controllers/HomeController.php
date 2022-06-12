<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $users = Member::join('accounts', 'account_id', 'accounts.id')
                ->select('users.name', 'avatar' , 'username')
                ->take(6)
                ->get();
        return view('layout.home', compact('users', $users));
    }
}
