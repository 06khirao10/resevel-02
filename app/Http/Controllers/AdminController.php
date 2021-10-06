<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;//追加//認証処理用ミドルウェア
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    public function __construct() {
        
        $this->middleware('auth');//ログインしていない場合は、ログイン画面を表示するように
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'new_password' => ['required', 'string', 'between:6,12', 'alpha_num', 'confirmed'],
        ]);
    }

    public function passwordEdit() { //パスワード編集ページ
    
        return view('auth.admin.passwordEdit');
    }
        
    public function passwordUpdate(Request $request) { //パスワード編集機能

            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                //パスワードがマッチしているかどうか
                return redirect()->back()->with("error","現在のパスワードが入力したパスワードと一致しません。");
            }
    
            if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
                //現在のパスワードと新しいパスワードが同じ
                return redirect()->back()->with("error","新しいパスワードを現在のパスワードと同じにすることができません。入力し直してください。");
            }
    
            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|between:6,12|alpha_num|confirmed',
            ]);
    
            //パスワード変更、homeにリダイレクト
            $admin = Auth::user();
            $admin->password = bcrypt($request->get('new-password'));
            $admin->save();
    
            return redirect()->route('admin.home')->with("success","Password changed successfully !");
        }
}
