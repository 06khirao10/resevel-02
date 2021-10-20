<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Reservation;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class UserController extends Controller
{
    public function home()
    {
        //今月の日時取得
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $from = Carbon::create($year, $month, 1)->firstOfMonth();
        $to = Carbon::create($year, $month, 1)->lastOfMonth();
        $period = CarbonPeriod::create($from, $to);
        $seat_date = [];

        foreach($period as $day){
            $seat_date[$day->format('Y-m-d 10:00:00')] = 10;
            $seat_date[$day->format('Y-m-d 14:00:00')] = 10;
        }
        //月の予約データを取り出す
        $this_month = Reservation::groupBy('start_datetime')
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
        return view('auth/user/home' ,['seat_date' => $seat_date,]);
    }

    public function nextMonth(){

        //来月の日時取得
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $from = Carbon::create($year, $month, 1)->firstOfMonth()->addMonth(1);
        $to = Carbon::create($year, $month, 1)->addMonth(1)->lastOfMonth();
        $period = CarbonPeriod::create($from, $to);
        $seat_date = [];

        foreach($period as $day){
            $seat_date[$day->format('Y-m-d 10:00:00')] = 10;
            $seat_date[$day->format('Y-m-d 14:00:00')] = 10;
        }

        //月の予約データを取り出す
        $this_month = Reservation::groupBy('start_datetime')
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
        return view('auth/user/nextMonth' ,['seat_date' => $seat_date ]);
    }

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

    public function adminindex(){
        $users=User::all();
        return view('auth/admin/users',['users'=>$users]);
    }
}
