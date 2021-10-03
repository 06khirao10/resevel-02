<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;
use DatePeriod;

class UserController extends Controller
{
    public function home()
    {
        //今月の日時取得
        $year = date('Y');
        $month = date('m');
        $from = date('Y-m-d', strtotime('first day of this month'));
        $to = date('Y-m-d', strtotime('first day of next month'));
        $period = new DatePeriod(new DateTime($from), new DateInterval('P1D'), new DateTime($to));
        $seat_date = [];

        foreach($period as $day){
            $seat_date[$day->format('Y-m-d 10:00:00')] = 10;
            $seat_date[$day->format('Y-m-d 14:00:00')] = 10;
        }

        //月の予約データを取り出す
        $this_month = DB::table('reservations')
            ->groupBy('start_datetime')
            ->whereYear('start_datetime', '=', $year)
            ->whereMonth('start_datetime', '=', $month)
            ->select('start_datetime', DB::raw("count(start_datetime) as count"))
            ->get();

        $this_month->each(function ($item) use (&$seat_date) {
            $count = $item->count;
            //例えば・・・レコード数が3だった時　席数10-レコード数3=残り席数7
            $remaining_seat = 10-$count;
            $date = $item->start_datetime;
            $seat_date[$date] = $remaining_seat;
        });
        return view('auth/user/home' ,['seat_date' => $seat_date ]);
    }
}
