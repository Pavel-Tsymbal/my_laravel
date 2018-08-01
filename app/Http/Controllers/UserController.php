<?php

namespace App\Http\Controllers;


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
}
