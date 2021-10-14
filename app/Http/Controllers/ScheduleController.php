<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function edit(){
        $admin = Auth::user();

        $firstOfMonth = Carbon::now()->firstOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $seat_date = [];

        for ($i = 0; true; $i++) {
            $date = $firstOfMonth->copy()->addDays($i);
            if ($date > $endOfMonth) {
            break;
            }
            $day = date('Y/m/d',strtotime($date));
            $dates[]=$day;
        }

        return view('schedules',compact('admin','dates'));
    }
}