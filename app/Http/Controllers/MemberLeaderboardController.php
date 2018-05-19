<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
class MemberLeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //user's name
        //User's mname
        $userId = Auth::id();
        $name_result = DB::table('user_details')
                    ->select('user_id','avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();


        //Mga user na andito ordered by exp(poiints)
   
        //own record
        $myown = DB::select("SELECT user_details.profile_status, user.avatar, stats.exp, level, stats.category from user inner join stats inner join user_details on user.id=stats.user_id=user_details.user_id where user.id=".$userId."");

        //expiration date of user till renewal
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');
        
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
                        ->where('receiver', '=', Auth::id())
                        ->where('read_at', '=', NULL)
                        ->where('sender', '=', 'System')
                        ->orderBy('notifications.id', 'desc')
                        ->limit(2)
                        ->get();
         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');

        $all_time_index = DB::table('stats')
                        ->select('total_exp', 'exp', 'level', DB::raw("concat(first_name, ' ', last_name) as Name"), 'nickname', 'avatar', 'category', 'stats.user_id as id')
                        ->join('user_details', 'user_details.user_id', '=', 'stats.user_id')
                        ->join('user', 'user.id', '=', 'stats.user_id')
                        ->orderby('level', 'desc')
                        ->where('user_type', '=', 'member')
                        ->limit(10)
                        ->get();

        return view('/member/leaderboard', compact('name_result', 'leaders', 'myown', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker', 'all_time_index'));


    }

    public function filter_leader(Request $request){

        
        //User's mname
        $userId = Auth::id();
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();
        //User's stats
        $myown = DB::select("SELECT level, user_details.profile_status, user.avatar, stats.exp, stats.category from user inner join stats inner join user_details on user.id=stats.user_id=user_details.user_id where user.id=".$userId."");
        // filter the leaders
    
         $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');

         $notify_member = DB::table('notifications')
                        ->select('*')
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->orwhere('sender', '=', 'System')
                        ->get();

        $notify_system = DB::table('notifications')
                        ->select('*')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('sender', '=', 'System')
                        ->get();

         // expiration locker till renewal

        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');
        $category = $request -> input('category');

        switch($category){
            case 'beginner':

            $all_time_index = DB::table('stats')
                        ->select('total_exp', 'exp', 'level', DB::raw("concat(first_name, ' ', last_name) as Name"), 'nickname', 'avatar', 'category', 'stats.user_id as id')
                        ->join('user_details', 'user_details.user_id', '=', 'stats.user_id')
                        ->join('user', 'user.id', '=', 'stats.user_id')
                        ->where('user_type', '=', 'member')
                        ->where('category', '=', 'Beginner')
                        ->orderby('total_exp', 'desc')
                        ->limit(10)
                        ->get();


            return view('/member/leaderboard', compact('name_result', 'all_time_index', 'myown', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker'));
            break;

            case 'intermediate':

            $all_time_index = DB::table('stats')
                        ->select('total_exp', 'exp', 'level', DB::raw("concat(first_name, ' ', last_name) as Name"), 'nickname', 'avatar', 'category', 'stats.user_id as id')
                        ->join('user_details', 'user_details.user_id', '=', 'stats.user_id')
                        ->join('user', 'user.id', '=', 'stats.user_id')
                        ->where('user_type', '=', 'member')
                        ->where('category', '=', 'Intermediate')
                        ->orderby('total_exp' , 'desc')
                        ->limit(10)
                        ->get();



            return view('/member/leaderboard', compact('name_result', 'all_time_index', 'myown', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker'));
            break;

            case 'expert':

            $all_time_index = DB::table('stats')
                        ->select('total_exp', 'exp', 'level', DB::raw("concat(first_name, ' ', last_name) as Name"), 'nickname', 'avatar', 'category', 'stats.user_id as id')
                        ->join('user_details', 'user_details.user_id', '=', 'stats.user_id')
                        ->join('user', 'user.id', '=', 'stats.user_id')
                        ->orderby('total_exp', 'desc')
                        ->where('user_type', '=', 'member')
                        ->where('category', '=', 'Advanced')
                        ->limit(10)
                        ->get();


            return view('/member/leaderboard', compact('name_result', 'all_time_index', 'myown', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker'));
            break;

            case 'badges':

            $all_time_index = DB::select("SELECT avatar, user_badge.user_id as id,level, concat(first_name,' ',last_name) as 'Name', total_exp, count(user_badge.user_id) as 'badge' FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id inner join user_badge on user_details.user_id = user_badge.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where user_type = 'member' AND status = 'active' group by 1,2,3,4,5 ORDER by badge DESC limit 10");


            return view('/member/leaderboard', compact('name_result', 'all_time_index', 'myown', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker'));
            break;

            case 'exp':

            $all_time_index = DB::table('stats')
                        ->select('total_exp', 'exp', 'level', DB::raw("concat(first_name, ' ', last_name) as Name"), 'nickname', 'avatar', 'category', 'stats.user_id as id')
                        ->join('user_details', 'user_details.user_id', '=', 'stats.user_id')
                        ->join('user', 'user.id', '=', 'stats.user_id')
                        ->orderby('exp', 'desc')
                        ->where('user_type', '=', 'member')
                        ->limit(10)
                        ->get();


        }

        return view('/member/leaderboard', compact('name_result', 'all_time_index', 'myown', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker'));
    }

   
}
