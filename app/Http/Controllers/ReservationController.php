<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use Carbon\Carbon;


class ReservationController extends Controller
{

    public function create(Request $request)
    //予約確認ページへ
    {
        //日時のみ受け取る
        $startDatetime = $request->startDatetime;
        //同一ユーザーが同一日付で予約している数を取得
        $user = Auth::user();
        $reservations = $user->reservations
            ->where('start_datetime', $startDatetime)
            ->count();
        //ユーザーが同日時に予約していたらエラー文表示
        if($reservations == 0){
            //もし予約が0なら予約確認ページへ移る
            return view('auth/user/create', ['startDatetime' => $startDatetime ]);
        } else {
            //予約がすでにあるならエラー文
            return redirect('/')->with('error', $startDatetime.'は既に予約しています');
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

    public function destroy(Request $request,Reservation $reservation)
    {
        $reservation->delete();
        return redirect('reservations');
    }

}
