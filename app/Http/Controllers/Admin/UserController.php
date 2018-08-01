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

    public function banUser(int $id){
        $user = User::find($id);
        if (!$user){
            return back()->with('error','Пользователь не найден!');
        }
        if($user->ban()){
            return back()->with('success','Пользователь ' . $user->name . ' успешно заблокирован!');
        }

        return back()->with('error', 'Не удалось заблокировать пользователя ' . $user->name);
    }

    public function unBanUser(int $id){
        $user = User::find($id);
        if (!$user){
            return back()->with('error','Пользователь не найден!');
        }
        if($user->unBan()){
            return back()->with('success','Пользователь ' . $user->name . ' успешно разблокирован!');
        }

        return back()->with('error', 'Не удалось разблокировать пользователя ' . $user->name);
    }
}
