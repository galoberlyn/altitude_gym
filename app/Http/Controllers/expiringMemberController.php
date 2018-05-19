<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_record;
use Carbon\Carbon;
use DB;
use Auth;

class expiringMemberController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function index() {

        $current = Auth::id();
        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        $expmem = Carbon::now()->addDays(1);
        $expmem1 = Carbon::now()->addDays(2);
        $expmem2 = Carbon::now()->addDays(3);
        $expmem3 = Carbon::now()->addDays(4);
        $expmem4 = Carbon::now()->addDays(5);
        $expmem5 = Carbon::now()->addDays(6);

        //auto update payment_status to unpaid 
        $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `payment_status` = 'unpaid' WHERE datediff(expiration_date, curdate()) = -1"); 

        $exp_mem = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where('expiration_date', '<=', DB::raw('curdate()'))
        ->where('payment_status', '=', 'unpaid')
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(5);

        $cur_exp = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where('expiration_date', '=', DB::raw('curdate()'))
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(15);

        $exp = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (expiration_date, curdate())"), '=', 3)
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(15);

        $expired = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (expiration_date, curdate())"), '=', 2)
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(15);

        $expiring = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (expiration_date, curdate())"), '=', 1)
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(15);

        $expired1 = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (expiration_date, curdate())"), '=', 4)
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(15);

        $expired2 = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (expiration_date, curdate())"), '=', 5)
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(15);

        $expired3 = DB::table('user_record')
        ->select('*')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->leftJoin('user', 'user_record.user_id', '=', 'user.id')
        ->where(DB::raw("datediff (expiration_date, curdate())"), '=', 6)
        ->where('user_type', '=', 'member')
        ->orderBy('expiration_date')
        ->paginate(15);

        //count expiring memberships
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

        //
        $user = DB::table('user_details')
        ->select('*')
        ->limit('10')
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

        return view ('ManagerModule/managerExpMem', compact('user', 'notification','cur_exp','exp','expired','expired1','expired2','expired3','expiring','exp_date','member','active_members','exp_mem','unpaid','expmem','expmem1','expmem2','expmem3','expmem4','expmem5'));

    }

/*        public function store() {

            $current = Auth::id();

        //auto update payment_status to unpaid 
        $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `payment_status` = 'unpaid' WHERE datediff(expiration_date, curdate()) = -1"); 

        //get expired memberships
        $exp_mem = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE expiration_date <= curdate() AND payment_status = 'unpaid' AND user_type = 'member' LIMIT 15"); 

        //get expiring memberships who expires in current date
        $payments = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE expiration_date = curdate() AND user_type = 'member'"); 

        //get expiring membership who expires before 3 days
        $exp = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 3 AND user_type = 'member'"); 

        //get expiring membership who expires before 2 days
        $expired = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 2 AND user_type = 'member'"); 

        //get expiring membership who expires before 1 day
        $expiring = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 1 AND user_type = 'member'"); 

        //count expiring memberships
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

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
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        return view ('ManagerModule\managerExpMem', compact('user', 'notification','payments','exp','expired','expiring','exp_date','member','active_members','exp_mem','unpaid'));

    }*/
}
