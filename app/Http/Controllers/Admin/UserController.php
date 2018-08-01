<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() {
        $users = User::get();
        $count = 0;

        return view('admin.users.index',['users'=>$users,'count'=>$count]);
    }
}
