<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;

class AdminNotifController extends Controller
{
    
	public function index() {
		
		date_default_timezone_set('Asia/Manila');
		
       $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");

        //
        $user = DB::table('user_details')
        ->select('*')
        ->limit('10')
        ->get(); 

       //get notification
          $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

		$notif_status = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'user.id', '=', 'notifications.sender')
        ->leftJoin('user_details', 'user.id', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->paginate(15);

        return view ('admin/notification', compact('user', 'notification','member','notif_status','active_members', 'mems', 'exp_date', 'daysdiffs'));

    }

    public function searchConfirm(Request $request) {
        
        //search function
        $searchBtn = Input::get('search_for');

        $notif_status = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'user.id', '=', 'notifications.sender')
        ->leftJoin('user_details', 'user.id', '=', 'user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn .'%')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->orWhere('message', 'like', $searchBtn .'%')
        ->orWhere('notifications.created_at', 'like', $searchBtn .'%')
        ->orWhere('notification_type', 'like', $searchBtn .'%')
        ->paginate(15);

        //get notification
          $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

          $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");


        //
        $user = DB::table('user_details')
        ->select('*')
        ->limit('10')
        ->get(); 

         return view ('admin/notification', compact('user', 'notification','member','notif_status','active_members', 'mems', 'exp_date', 'daysdiffs'));

    }

    public function sorting_notif() {

    $sortBtn = Input::get('sorting_notif');
    $searchBtn = Input::get('search_for');

        $notif_status = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'user.id', '=', 'notifications.sender')
        ->leftJoin('user_details', 'user.id', '=', 'user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn .'%')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->orWhere('message', 'like', $searchBtn .'%')
        ->orWhere('notifications.created_at', 'like', $searchBtn .'%')
        ->orWhere('notification_type', 'like', $searchBtn .'%')
        ->orderBy('first_name', $sortBtn)
        ->paginate(15);

        //get notification
        $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('user_type', '=', 'manager')
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 
        
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");
        
        //count members
         $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
         $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");



   return view ('admin/notification', compact('notif_status','notification', 'exp_date', 'users', 'available', 'member', 'active_members'));
    }
     public function read_atad() {

        $current = Auth::id();

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();
        $send = Input::get('send');
        $snd = Input::get('snd');

        //return $current;

        $read_at = DB::table('notifications')
        ->where('receiver', '=', $current)
        ->where('id', '=', $send)
        ->update([
            'read_at' => $current_time
            ]);

        return redirect('/notification_a');

        
    }

    public function read_allad() {

        $current = Auth::id();

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        $read_all = DB::table('notifications')
        ->where('receiver', '=', $current)
        ->whereNull('read_at')
        ->update([
            'read_at' => $current_time
            ]);

        return redirect('/notification_a');


    }
}
