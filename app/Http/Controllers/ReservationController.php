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
}
