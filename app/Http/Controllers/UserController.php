<?php

namespace App\Http\Controllers;


use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    public function profile(){
        return view('profile',['user'=> Auth::user()]);
    }

    public function update_avatar(Request $request){

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $fileName = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/' . $fileName));

            $user = Auth::user();
            $user->avatar = $fileName;
            $user->save();

        }

        return view('profile',['user'=> Auth::user()]);
    }

    public function showUserProfile(string $email){
        $user = User::where('email',$email)->first();
        if(!$user){
            return back()->with('error','Пользователь не найден!');
        }
        return view('users.profile',['user'=>$user]);
    }
}
