<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Image;
use Carbon\Carbon;
class MemberProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                            ->select('*')
                            ->join('badges', 'badges.id', '=', 'user_badge.badge_id')
                            ->where('user_id', '=', $userId)
                            ->get();

        //ExpDate
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');

        //user's dp
        $dp = DB::table('user')
                ->select('avatar')
                ->where('id', '=', $userId)
                ->get();

        //User age/bday
       $query = "SELECT YEAR(CURDATE()) - YEAR(birthdate) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(birthdate), '-', DAY(birthdate)) ,'%Y-%c-%e') > CURDATE(), 1, 0) AS age, civil_status, sex, address, profile_status, email_address, contact_no, school_workplace, emergency_contact, emergency_no, used_gym, occupation FROM user_details where user_id=".$userId;         
        $profile = DB::select($query);         

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

        $current_goals = DB::table('user_goals')
                        ->select('*')
                        ->where('user_id', '=', Auth::id())
                        ->where('goal_status', '=', 'undone')
                        ->limit(4)
                        ->get();

        // countes the day of the user_program
         $user_workout = DB::table('user_program')
                                ->select('day', 'point_status')
                                ->distinct('day')
                                ->where("user_id", "=", Auth::id())
                                ->where("row_status", "=", 'active')
                                ->orderBy('day')
                                ->get();
                        
       
        return view('member/myprofile', compact('name_result', 'user_lvl', 'user_achievement', 'exp_date', 'profile', 'dp', 'notify_member', 'notify_system', 'exp_date_locker', 'current_goals', 'user_workout'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
