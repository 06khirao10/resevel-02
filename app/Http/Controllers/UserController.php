<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function passwordEdit(){
        return view('auth.user.password-edit');
    }

    public function passwordUpdate(Request $request){
        $user = Auth::user();
        $up_post = $request->all();
        $val = $this->validator($up_post);
        if ($val->fails()) {
            return redirect('password-edit')
                        ->withErrors($val)
                        ->withInput();
        }
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with('update_password_success', 'パスワードを変更しました。');
    }

    protected function validator(array $up_post)
    {
        return Validator::make($up_post, [
            'new-password' => 'required|string|min:4|max:12|alpha_num|confirmed',
            'new-password_confirmation' => 'required|same:new-password',
        ],[
            'new-password.required' => 'パスワードを入れてください',
            'new-password.alpha_num' => '英数字のみで入れてください',
            'new-password.min' => '4文字以上で入れてください',
            'new-password.max' => '12文字いないで入れてください',
            'new-password_confirmation.required' => 'パスワードを入れてください',
            'new-password_confirmation.same:new-password' => 'パスワードが違います',
        ]);
    }
}
