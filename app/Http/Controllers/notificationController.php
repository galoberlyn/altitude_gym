<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use Auth;

class notificationController extends Controller {

	public function index() {

        $current = Auth::id();

        //count expiring memberships
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

       //get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        $notif_status = DB::table('notifications')
        ->select('*', 'notifications.created_at')
        ->leftJoin('user', 'user.id', '=', 'notifications.sender')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->paginate(15);

        return view ('ManagerModule/notification', compact('notification','exp_date','member','active_members','notif_status'));

    }

    public function searchConfirm(Request $request) {

        $current= Auth::id();
        
        //search function
        $searchBtn = Input::get('search_for');

        $notif_status = DB::table('notifications')
        ->select('*','notifications.created_at')
        ->leftJoin('user', 'user.id', '=', 'notifications.sender')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('first_name', 'like', $searchBtn .'%')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->orWhere('message', 'like', $searchBtn .'%')
        ->orWhere('notifications.created_at', 'like', $searchBtn .'%')
        ->orWhere('notification_type', 'like', $searchBtn .'%')
        ->orWhere('user_type', 'like', $searchBtn .'%')
        ->paginate(15);

        //get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        //count expiring memberships
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

        return view ('ManagerModule/notification', compact('notification','exp_date','member','active_members','notif_status'));

    }

    public function sorting_notif() {

        $current = Auth::id();

        $sortBtn = Input::get('sorting_notif');
        $searchBtn = Input::get('search_for');

        $notif_status = DB::table('notifications')
        ->select('*','notifications.created_at')
        ->leftJoin('user', 'user.id', '=', 'notifications.sender')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('first_name', 'like', $searchBtn .'%')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->orWhere('message', 'like', $searchBtn .'%')
        ->orWhere('notifications.created_at', 'like', $searchBtn .'%')
        ->orWhere('notification_type', 'like', $searchBtn .'%')
        ->orWhere('user_type', 'like', $searchBtn .'%')
        ->orderBy('first_name', $sortBtn)
        ->paginate(15);

        //get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 
        
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");
        
        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'"); 



        return view ('ManagerModule/notification', compact('notif_status','notification', 'exp_date', 'users', 'available', 'member', 'active_members'));
    }

    public function read_at() {

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

        return redirect('/managerNotification');

        
    }

    public function read_conf() {

        $current = Auth::id();

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();
        $snd = Input::get('snd');


        $read_conf = DB::table('notifications')
        ->where('receiver', '=', $current)
        ->where('id', '=', $snd)
        ->update([
            'read_at' => $current_time
            ]);

        return redirect('/confirmation');
    }

    public function read_all() {

        $current = Auth::id();

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        $read_all = DB::table('notifications')
        ->where('receiver', '=', $current)
        ->whereNull('read_at')
        ->update([
            'read_at' => $current_time
            ]);

        return redirect('/managerNotification');


    }
}
