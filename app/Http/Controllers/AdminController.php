<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data,[
        'new-password' => 'required|string|between:6,12|alpha_num|confirmed',
        'new-password_confirmation' => 'required|same:new-password',],[
        'new-password.required' => 'パスワードを入れてください',
        'new-password.alpha_num' => '英数字のみ入れてください',
        'new-password.min' => '6文字以上入力してください',
        'new-password.max' => '12文字以下で入力してください',
        'new-password-confirmation.required' => 'パスワードを入れてください',
        'new-password-confirmation.same:new-password' => 'パスワードが違います',
        ]);
        
    }
    //パスワード編集ページ
    public function passwordEdit(){

        return view('auth.admin.passwordEdit');
    }
    //パスワード編集機能
    public function passwordUpdate(Request $request){    
        $admin = Auth::user();
        $data = $request->all();
        $val = $this->validator($data);
        if ($val->fails()){
            return redirect()->route('admin.passwordEdit')
            ->withErrors($val)
            ->withInput();
        }
        $admin->password = bcrypt($request->get('new-password'));
        $admin->save();
        return redirect()->back()->with('success', 'パスワードを変更しました');  
    }
}
