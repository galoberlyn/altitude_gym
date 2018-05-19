<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
class MemberTransactionsController extends Controller
{
    //
    public function index(){

    	$exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.Auth::id().'"');
                  
        $notify_member = DB::table('notifications')
                        ->select('*')
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('read_at', '=', NULL)
                        ->orwhere('sender', '=', 'System')
                        ->orderBy('notifications.id', 'desc')
                        ->get();

        $notify_system = DB::table('notifications')
                        ->select('*')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('read_at', '=', NULL)
                        ->where('sender', '=', 'System')
                        ->orderBy('notifications.id', 'desc')
                        ->get();

        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', Auth::id())
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();

        //user transaction records
        $transac = DB::table('user_record')
        		->select('*', DB::raw('DATE_FORMAT(expiration_date, "%b %d, %Y") as date'))
        		->where('user_id', '=', Auth::id())
        		->get();



      	$times = DB::table('user_log')
      			->select(DB::raw('DATE_FORMAT(date_recorded, "%b, %d, %Y") as wewdate'), 'time_in','time_out')
      			->where('user_id', '=', Auth::id())
      			->paginate(10);


         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT locker_number, datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');


    	return view('member.member_transactions', compact('notify_system', 'notify_member', 'name_result', 'exp_date', 'transac', 'times', 'exp_date_locker'));
    }
}
