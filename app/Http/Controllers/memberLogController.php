<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use  Auth;

class memberLogController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');

    }
    
    function index(Request $request){

        $current = Auth::id();

        //get member details
        $memberSearch = DB::table('user_log')
        ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status', 'user_log.time_in', 'user_log.time_out', 'user_log.date_recorded','user.avatar','user_log.updated_at','user.id_number')
        ->leftJoin('user_details', 'user_log.user_id', '=', 'user_details.user_id')
        ->leftJoin('user_record', 'user_record.user_id', '=', 'user_log.user_id')
        ->leftJoin('locker','user_log.user_id','=','locker.user_id')
        ->leftJoin('user', 'user.id', '=', 'user_log.user_id')
        ->orderBy('user_log.updated_at')
        ->where('user_type', '=', 'member')
        ->paginate(15);

    	//count expiring membership
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

        //auto change status to inactive
        $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 

        return view ('ManagerModule/memberLogManager', compact('memberSearch' , 'notification','exp_date','member','active_members','inactive'));

    }

    public function searcher(Request $request) {

        $current = Auth::id();
        
        //search memeber
        $searchBtn = Input::get('searcher');
        
        $memberSearch = DB::table('user_log')
        ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status', 'user_log.time_in', 'user_log.time_out', 'user_log.date_recorded','user.user_type','user.avatar','user.id_number')
        ->leftJoin('user_details', 'user_log.user_id', '=', 'user_details.user_id')
        ->leftJoin('user_record', 'user_record.user_id', '=', 'user_log.user_id')
        ->leftJoin('locker','user_log.user_id','=','locker.user_id')
        ->leftJoin('user', 'user.id', '=', 'user_log.user_id')
        ->orderBy('user_details.first_name')
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('id_number', '=', $searchBtn)
        ->where('user_type', '=', 'member')
        ->orWhere('date_recorded', 'like', '%' . $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('time_in', 'like', '%'. $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('time_out', 'like', '%' . $searchBtn .'%')
        ->paginate(15);

        //get locker
        $memberLocker = DB::table('locker')
        ->select('status','locker_number')
        ->where('status','=','available')
        ->get();

       //get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        //auto change status to inactive
        $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");
        
        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

        return view ('ManagerModule/memberLogManager', compact('memberSearch','notification','memberLocker', 'exp_date', 'users', 'available', 'inactive', 'member', 'active_members'));
    }

    public function sorting() {

        $current = Auth::id();

        $sortBtn = Input::get('sorting');
        $searchBtn = Input::get('search');
        $memberSearch = DB::table('user_log')
        ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status', 'user.avatar','user_log.date_recorded', 'user_log.time_in','user_log.time_out','user.id_number')
        ->leftJoin('user_details', 'user_log.user_id', '=', 'user_details.user_id')
        ->leftJoin('user_record', 'user_record.user_id', '=', 'user_log.user_id')
        ->leftJoin('user', 'user_log.user_id', '=', 'user.id')
        ->leftJoin('locker','user_log.user_id','=','locker.user_id')
        ->where ('user.user_type', '=', 'member')
        ->orderBy('user_details.first_name', $sortBtn)
        ->paginate(15);


        //get locker
        $memberLocker = DB::table('locker')
        ->select('status','locker_number')
        ->where('status','=','available')
        ->get();

        //get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        //auto change status to inactive
        $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");
        
        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'"); 

        return view ('ManagerModule/memberLogManager', compact('memberSearch','notification','memberLocker', 'exp_date', 'users', 'available', 'inactive', 'member', 'active_members'));
    }
}
