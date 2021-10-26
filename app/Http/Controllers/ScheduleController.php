<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ReservationNotPossible;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    //NG日設定画面表示（今月）
    public function edit(){
        $admin = Auth::user();
        //今月1日を取得
        $firstOfMonth = Carbon::now()->firstOfMonth();
        //今月末日を取得
        $endOfMonth = Carbon::now()->endOfMonth();

        //1日から末日まで1日ずつ足す
        for ($i = 0; true; $i++) {
            $date = $firstOfMonth->copy()->addDays($i);
            if ($date > $endOfMonth) {
            break;
            }
            //今月全ての日付を配列に入れる（toDateStringメソッドで日付のみにする）
            $dates[]=$date->toDateString();
        }

        $button = ReservationNotPossible::get()->toArray();

        return view('auth/admin/schedules',compact('admin','dates','button'));
    }

    //NG日設定画面表示（次月）
    public function nextMonth(){
        $admin = Auth::user();

        //来月1日を取得
        $firstOfNextMonth = Carbon::now()->firstOfMonth()->addMonth(1);
        //来月末日を取得（addMonthメソッドだと11月の場合12月1日を取得してしまうのでaddMonthNoOverflowメソッド使用）
        $endOfNextMonth = Carbon::now()->endOfMonth()->addMonthNoOverflow(1);

        //1日から末日まで1日ずつ足す
        for ($i = 0; true; $i++) {
            $date = $firstOfNextMonth->copy()->addDays($i);
            if ($date > $endOfNextMonth) {
            break;
            }
            //来月全ての日付を配列に入れる（toDateStringメソッドで日付のみにする）
            $dates[]=$date->toDateString();
        }

        $button = ReservationNotPossible::get()->toArray();

        return view('auth/admin/nextMonthSchedules',compact('admin','dates','button'));
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