<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class MemberDoneController extends Controller
{
    //
    public function index(){

    	$my_workouts = DB::table("user_program")
    				->select(DB::raw("ANY_VALUE(type) as type"), DB::raw("DATE_FORMAT(updated_at, '%b %d, %Y') as updated_at"))
    				->where('user_id', '=', Auth::id())
    				->where('row_status', '=', 'archived')
    				->groupBy('updated_at')
    				->paginate(10);

    	$date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since member
        $daysdiff = DB::select('SELECT datediff("'.Carbon::now().'", created_at) as daysdiff, DATE_FORMAT(created_at, "%b %d, %Y") as since FROM user WHERE id = "'.Auth::id().'"');
        
        //expiration date of user till renewal
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.Auth::id().'"');

        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');
                  
        $notify_member = DB::table('notifications')
                        ->select('*')
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('read_at', '=', NULL)
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

        return view('member/done_progs', compact('my_workouts', 'days_diff', 'exp_date', 'exp_date_locker', 'notify_member', 'notify_system', 'name_result'));

    }
}
