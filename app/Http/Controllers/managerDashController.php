<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;

class managerDashController extends Controller
{

    public function index() {

        $current = Auth::id();
        $zone = date_default_timezone_set('Asia/Manila');

        //count active members
        $act_members = DB::select("SELECT COUNT(user.id) as status from user INNER JOIN user_record ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

        //count members
        $mems = DB::select("SELECT count(user.id) as status from user WHERE user_type = 'member'"); 
        
        //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count new members
        $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        $beginner = DB::select("SELECT avatar, exp, level ,concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where stats.category = 'beginner' AND user_type = 'member' AND status = 'active' ORDER by 3 DESC, 2 DESC limit 10");

        $intermediate = DB::select("SELECT avatar, exp, level, concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where stats.category = 'intermediate' AND user_type = 'member' AND status = 'active' ORDER by 3 DESC, 2 DESC limit 10");

        $advance = DB::select("SELECT avatar, exp, level, concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where stats.category = 'advance' AND user_type = 'member' AND status = 'active' ORDER by 3 DESC, 2 DESC limit 10");

        $recentaward = DB::select("SELECT avatar, user_badge.user_id, concat(first_name,' ',last_name) as 'Name', exp as 'Point', level,count(user_badge.user_id) as 'badge' FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id inner join user_badge on user_details.user_id = user_badge.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where user_type = 'member' AND status = 'active' group by 1,2,3,4,5 ORDER by badge DESC limit 10");

        return view ('ManagerModule/managerDash', compact('notification','act_members','mems','exp_date','daysdiffs','beginner','intermediate','recentaward','advance'));

    }

}
