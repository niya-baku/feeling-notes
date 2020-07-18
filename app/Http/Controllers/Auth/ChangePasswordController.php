<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }
    public function setindex(){
        $user = Auth::user();

        return $user;
    }

    public function change(ChangePasswordRequest $request){
        $user = Auth::user();

        if(($request->get('currentpassword') || $request->get('newpassword')) == null ){
            return response($user, 422);
        }

        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('currentpassword'), $user->password))) {
            return response($user, 422);
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0) {
            return response($user, 422);
        }

        //パスワードを変更

        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        return response($user, 200);
    }
}
