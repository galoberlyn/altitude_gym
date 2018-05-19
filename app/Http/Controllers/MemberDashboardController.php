<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
class MemberDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Query needs refactoring.

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

        //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since member
        $daysdiff = DB::select('SELECT datediff("'.Carbon::now().'", created_at) as daysdiff, DATE_FORMAT(created_at, "%b %d, %Y") as since FROM user WHERE id = "'.$userId.'"');
        
        //expiration date of user till renewal
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');

       
                  
        $notify_member = DB::table('notifications')
                        ->select('*')
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->orderBy('notifications.id', 'desc')
                        ->where('read_at', '=', NULL)
                        ->get();

        $notify_system = DB::table('notifications')
                        ->select('*')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('sender', '=', 'System')
                        ->where('read_at', '=', NULL)
                        ->orderBy('notifications.id', 'desc')
                        ->get();

        //all time leaders
        $all_time = DB::table('stats')
                    ->select('total_exp', 'first_name', 'last_name', 'avatar')
                    ->join('user_details', 'stats.user_id', '=', 'user_details.user_id')
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->where('user_type', '=', 'member')
                    ->limit(5)
                    ->orderby('total_exp', 'desc')
                    ->get();



        $workout = DB::table('user_program')
                    ->select('id')
                    ->where('user_id', '=', Auth::id())
                    ->where('row_status', '=', 'active')
                    ->get();

         $user_workout = DB::table('user_program')
                                ->select('day', 'point_status')
                                ->distinct('day')
                                ->where("user_id", "=", Auth::id())
                                ->where("row_status", "=", 'active')
                                ->orderBy('day')
                                ->get();
        
         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');


        $reward = $this->badge_rewarder();

        if($reward){

            return view('member/dashboard', 
            compact('name_result', 'user_lvl', 'user_achievement', 'date_today', 'daysdiff', 'exp_date', 'notify_member', 'notify_system', 'all_time', 'workout',  'exp_date_locker', 'user_workout'))->with('badge', 'earned');

        }else{

            return view('member/dashboard', 
            compact('name_result', 'user_lvl', 'user_achievement', 'date_today', 'daysdiff', 'exp_date', 'notify_member', 'notify_system', 'all_time', 'workout', 'exp_date_locker', 'user_workout'));
        }

        

    }

    public function badge_rewarder(){
        
        $determine = false;
        //GYM ADEPT -- rewarded for 1 month membership

       $month_registered = DB::table('user')
                        ->select(DB::raw('datediff("'.Carbon::now().'", created_at ) as since'))
                        ->where('id', '=', Auth::id())
                        ->get();

        foreach($month_registered as $reg_span){

            if($reg_span->since == 30){

            //check muna kung meron na yung achievement
                $counter = DB::table('user_badge')
                        ->select('badge_id', 'badge_name', 'badge_description', 'date_achieved')
                        ->join('badges', 'user_badge.badge_id', '=', 'badges.id')
                        ->where('user_id', '=', Auth::id())
                        ->where('badge_name', '=', 'GYM ADEPT')
                        ->get();

                //kung wala, lagay ka na
                if(count($counter)===0){

                    DB::table('user_badge')
                    ->insert([
                        "user_id" => Auth::id(),
                        "badge_id"=>$req_span->id,
                        "date_achieved" => Carbon::now(),
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now()
                    ]);

                }
                    $determine=true;

             }
        }

        //GYM INTERMEDIATE -- rewarded for 6 months membership

        foreach($month_registered as $reg_span){

            if($reg_span->since == 180){

            //check muna kung meron na yung achievement
                $counter = DB::table('user_badge')
                        ->select('badge_id', 'badge_name', 'badge_description', 'date_achieved')
                        ->join('badges', 'user_badge.badge_id', '=', 'badges.id')
                        ->where('user_id', '=', Auth::id())
                        ->where('badge_name', '=', 'GYM INTERMEDIATE')
                        ->get();

                //kung wala, lagay ka na
                if(count($counter)===0){

                    DB::table('user_badge')
                    ->insert([
                        "user_id" => Auth::id(),
                        "badge_id"=>$req_span->id,
                        "date_achieved" => Carbon::now(),
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now()
                    ]);

                }
                    $determine=true;

             }
        }
       
       //GYM VETERAN -- rewarded for 1 year membership

        foreach($month_registered as $reg_span){

            if($reg_span->since == 365){

            //check muna kung meron na yung achievement
                $counter = DB::table('user_badge')
                        ->select('badge_id', 'badge_name', 'badge_description', 'date_achieved')
                        ->join('badges', 'user_badge.badge_id', '=', 'badges.id')
                        ->where('user_id', '=', Auth::id())
                        ->where('badge_name', '=', 'GYM INTERMEDIATE')
                        ->get();

                //kung wala, lagay ka na
                if(count($counter)===0){

                    DB::table('user_badge')
                    ->insert([
                        "user_id" => Auth::id(),
                        "badge_id"=>$req_span->id,
                        "date_achieved" => Carbon::now(),
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now()
                    ]);

                }
                    $determine=true;

             }
        }

       


    }

   
}
