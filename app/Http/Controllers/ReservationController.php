<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function adminHome()
    {
        $admin = Auth::user();
        return view('auth.admin.home',compact('admin'));
    }

    public function index()
    {
        $list = \DB::table('reservations')
        ->leftJoin('users','users.id','=','reservations.user_id')
        ->where('users.id',Auth::id())
        ->select('reservations.*')
        ->orderBy('id', 'desc')->get();
        return view('auth/user/reservations',['list'=>$list]);
    }

    public function destroy($id)
    {
        \DB::table('reservations')
            ->where('id', $id)
            ->delete();
        return redirect('auth/user/reservations');
    }

}
