<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
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

    public function change(Request $request){
        if(($request->get('oldpassword') || $request->get('oldpassword')) == null ){
            return abort(422);
        }

        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('oldpassword'), Auth::user()->password))) {
            return abort(422);
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('oldpassword'), $request->get('newpassword')) == 0) {
            return abort(422);
        }

        $validated_data = $request->validate([
            'oldpassword' => ['required'],
            'newpassword' => ['required', 'string', 'min:8', 'confirmed']
        ]);


        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        return response($user, 200);
    }
}
