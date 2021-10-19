<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;

class ReservationController extends Controller
{
    public function adminHome()
    {
        $admin = Auth::user();
        return view('auth.admin.home',compact('admin'));
    }

    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations;
        return view('auth.user.reservations',['reservations'=>$reservations]);
    }

    public function destroy(Request $request,Reservation $reservation)
    {
        $reservation->delete();
        return redirect('reservations');
    }

}
