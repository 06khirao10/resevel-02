<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{

    public function create(Request $request)
    //予約確認ページへ
    {
        //開始日時のみ受け取る
        $startDatetime = $request->startDatetime;
        //同一ユーザーが同一日付で予約している数を取得
        $user = Auth::user();
        $reservations = $user->reservations
            ->where('start_datetime', $startDatetime)
            ->count();
        //ユーザーが同日時に予約していたらエラー文表示
        if($reservations){
           //予約がすでにあるならエラー文
            return redirect('/')->with('error', $startDatetime.'は既に予約しています');
        } else {
            //もし予約が0なら予約確認ページへ移る
            return view('auth/user/create', ['startDatetime' => $startDatetime ]);
        }
    }

    public function store(Request $request)
    //予約をデータベースへ登録（予約する人のid、日時、要件）
    {
        //id取得
        $userId = Auth::user()->id;
        //開始日時取得
        $startDatetime = $request->startDatetime;
        //終了日時取得
        $endDatetime = Carbon::create($startDatetime)->addHour(3);
        //要件取得
        $requirements = $request->requirements;

        //create メソッドで予約保存
        Reservation::create(['user_id' => $userId, 'requirements' => $requirements, 'start_datetime' => $startDatetime, 'end_datetime' => $endDatetime ]);

        return view('auth/user/thanks');
    }

    public function adminHome()
    //管理ホーム画面
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

    public function adminIndex()
    //管理者用予約一覧画面
    {
        $admin = Auth::user();
        //今月分のデータ取得
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $reservations = Reservation::leftjoin('users', 'reservations.user_id', '=', 'users.id')
            ->whereYear('reservations.start_datetime', '=', $year)
            ->whereMonth('reservations.start_datetime', '=', $month)
            ->select('users.name', 'reservations.start_datetime', 'reservations.end_datetime')
            ->orderByRaw('reservations.start_datetime', 'asc')
            ->get();

            return view('auth.admin.reservations', [
            'admin' => $admin,
            'reservations' => $reservations
        ]);
    }

    public function destroy(Request $request,Reservation $reservation)
    {
        $reservation->delete();
        return redirect('reservations');
    }

        public function updateHome($id)
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
        return view('auth/user/updateHome' ,['seat_date' => $seat_date,'id' => $id,]);
    }

    public function update(Request $request, Reservation $reservation)
    {

        $reservation->start_datetime = $request->startDatetime;
        $endDatetime = Carbon::create($request->startDatetime)->addHour(3);
        $reservation->end_datetime = $endDatetime;
        $user = Auth::user();
        $reservations = $user->reservations
            ->where('start_datetime', $request->startDatetime)
            ->count();
        //ユーザーが同日時に予約していたらエラー文表示
        if($reservations){
            //予約がすでにあるならエラー文
             return redirect('reservations')->with('error', $request->startDatetime.'は既に予約しています');
        }
        $reservation->save();
        return redirect('reservations');
    }
}
