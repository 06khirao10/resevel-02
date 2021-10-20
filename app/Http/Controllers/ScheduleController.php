<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ReservationNotPossible;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    //NG日設定画面表示
    public function edit(){
        $admin = Auth::user();

        $firstOfMonth = Carbon::now()->firstOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        for ($i = 0; true; $i++) {
            $date = $firstOfMonth->copy()->addDays($i);
            if ($date > $endOfMonth) {
            break;
            }
            //今月の日付を配列に入れる
            $dates[]=$date->toDateString();
        }

        $button = ReservationNotPossible::get()->toArray();

        return view('schedules',compact('admin','dates','button'));
    }

    //予約NG日登録
    public function store(Request $request){
        $date = $request->input('add');

        ReservationNotPossible::create([
            'date' => $date,
        ]);

        return back();
    }

    //予約可能日登録
    public function destroy(Request $request){
        $date = $request->input('remove');

       ReservationNotPossible::where('date','=',$date) ->delete();

        return back();
    }
}