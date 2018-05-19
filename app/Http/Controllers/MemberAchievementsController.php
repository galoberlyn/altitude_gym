<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
class MemberAchievementsController extends Controller
{
    //

    public function index(){

        //User's mname
        $userId = Auth::id();
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();


        //User's level and rank(beginner)
        $user_lvl = DB::table('stats')
                ->select('*' , 'stats.level as slevel', 'stats.category as scat', 'points.category')
                ->join('points', 'stats.category', '=', 'points.category')
                ->where('stats.user_id', '=', Auth::id())
                ->get();

        //User's Achievements
        $user_achievement = DB::table('user_badge')
                            ->select(DB::raw('count(id) as id'))
                            ->where('user_id', '=', $userId)
                            ->get();

        //count the number of days since member
        $daysdiff = DB::select('SELECT datediff("'.Carbon::now().'", created_at) as daysdiff, DATE_FORMAT(created_at, "%b %d, %Y") as since FROM user WHERE id = "'.$userId.'"');
        
        //expiration date of user till renewal
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');
                  
        $notify_member = DB::table('notifications')
                        ->select('*')
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('read_at', '=', NULL)
                        ->orwhere('sender', '=', 'System')
                        ->orderBy('notifications.created_at', 'desc')
                        ->get();

        $notify_system = DB::table('notifications')
                        ->select('*')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('sender', '=', 'System')
                        ->where('read_at', '=', NULL)
                        ->orderBy('notifications.created_at', 'desc')
                        ->get();

        $all_badge = DB::select('SELECT badge_name, badge_description from badges where NOT EXISTS (select badge_id from user_badge where badges.id=user_badge.badge_id AND user_id ="'.Auth::id().'" )');

        $user_badge = DB::table('user_badge')
                    ->select('badge_id', 'badge_name', 'badge_description', DB::raw("DATE_FORMAT(user_badge.updated_at, '%b, %d, %Y') as date"))
                    ->join('badges', 'badge_id', '=', 'badges.id')
                    ->orderBy('badges.id')
                    ->where('user_badge.user_id', '=', Auth::id())
                    ->get();



   
         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');


    	return view('member.member_achievements', compact('user_lvl', 'user_achievement', 'daysdiff', 'exp_date', 'notify_member', 'notify_system', 'name_result', 'all_badge', 'user_badge', 'exp_date_locker'));
    }
}
