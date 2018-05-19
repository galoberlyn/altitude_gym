<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use Auth;

class expiringLockerController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index() {

        $current = Auth::id();
        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        $explock = Carbon::now()->addDays(1);
        $explock1 = Carbon::now()->addDays(2);
        $explock2 = Carbon::now()->addDays(3);
        $explock3 = Carbon::now()->addDays(4);
        $explock4 = Carbon::now()->addDays(5);
        $explock5 = Carbon::now()->addDays(6);

        $exp_lock = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where('date_expiry', '<=', DB::raw('curdate()'))
        ->where('user_type', '=', 'member')
        ->orderBy('date_expiry')
        ->paginate(5);

        $exp_lock1 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where('date_expiry', '=', DB::raw('curdate()'))
        ->where('user_type', '=', 'member')
        ->paginate(15);

        $exp_lock2 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 1)
        ->where('user_type', '=', 'member')
        ->paginate(15);

        $exp_lock3 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 2)
        ->where('user_type', '=', 'member')
        ->paginate(15);

        $exp_lock4 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 3)
        ->where('user_type', '=', 'member')
        ->paginate(15);

        $exp_lock5 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 4)
        ->where('user_type', '=', 'member')
        ->paginate(15);

        $exp_lock6 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 5)
        ->where('user_type', '=', 'member')
        ->paginate(15);

        $exp_lock7 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 6)
        ->where('user_type', '=', 'member')
        ->paginate(15);

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

        return view ('ManagerModule/expiringLocker', compact('notification','exp_date','member','active_members', 'exp_lock', 'exp_lock1', 'exp_lock2', 'exp_lock3', 'exp_lock4', 'exp_lock5', 'exp_lock6', 'exp_lock7','explock','explock1','explock2','explock3','explock4','explock5'));
    }

/*public function search_memlock(Request $request) {

        $current = Auth::id();
        
        //search memeber
        $searchBtn = Input::get('searcher');
        
        $exp_lock = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '<=', 5)
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn .'%')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->orWhere('user_details.user_id', '=', $searchBtn)
        ->orWhere('date_expiry', 'like', '%' . $searchBtn .'%')
        ->orWhere('locker_number', '=', $searchBtn)
        ->paginate(15);

        $searchBtn1 = Input::get('searcher1');

         $exp_lock1 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where('date_expiry', '=', DB::raw('curdate()'))
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn1 .'%')
        ->orWhere('last_name', 'like', $searchBtn1 .'%')
        ->orWhere('user_details.user_id', '=', $searchBtn1)
        ->orWhere('locker_number', '=', $searchBtn1)
        ->paginate(15);

        $searchBtn2 = Input::get('searcher2');

        $exp_lock2 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 1)
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn2 .'%')
        ->orWhere('last_name', 'like', $searchBtn2 .'%')
        ->orWhere('user_details.user_id', '=', $searchBtn2)
        ->orWhere('locker_number', '=', $searchBtn2)
        ->paginate(15);

        $searchBtn3 = Input::get('searcher3');

        $exp_lock3 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 2)
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn3 .'%')
        ->orWhere('last_name', 'like', $searchBtn3 .'%')
        ->orWhere('user_details.user_id', '=', $searchBtn3)
        ->orWhere('locker_number', '=', $searchBtn3)
        ->paginate(15);

        $searchBtn4 = Input::get('searcher4');

        $exp_lock4 = DB::table('locker')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'locker.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (date_expiry, curdate())"), '=', 3)
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn4 .'%')
        ->orWhere('last_name', 'like', $searchBtn4 .'%')
        ->orWhere('user_details.user_id', '=', $searchBtn4)
        ->orWhere('locker_number', '=', $searchBtn4)
        ->paginate(15);


       //get notification
        $notification = DB::table('notifications')
        ->select('*')
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


    return view ('ManagerModule\expiringLocker', compact('notification','exp_date','member','active_members','inactive', 'exp_lock', 'exp_lock1', 'exp_lock2', 'exp_lock3', 'exp_lock4'));
}*/

}
