<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
class MemberViewProfileController extends Controller
{

    //View the profile of user hehe

    public function view_profile($id){

        //User na nakalogin's name
        $userId = Auth::id();
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();

        //Viewing user profile
        $name_result_other = DB::table('user_details')
                    ->select(DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $id)
                    ->get();


        //Other's level and rank(beginner)
        $user_lvl = DB::table('stats')
                ->select('*' , 'stats.level as slevel', 'stats.category as scat', 'points.category')
                ->join('points', 'stats.category', '=', 'points.category')
                ->where('stats.user_id', '=', $id)
                ->get();

        //other's Achievements
        $user_achievement = DB::table('user_badge')
                            ->select(DB::raw('count(id) as id'))
                            ->where('user_id', '=', $id)
                            ->get();

        //ExpDate
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');

        //other's dp
        $dp = DB::table('user')
                ->select('avatar')
                ->where('id', '=', $id)
                ->get();

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
                        ->where('sender', '=', 'System')
                        ->where('read_at', '=', NULL)
                        ->orderBy('notifications.id', 'desc')
                        ->limit(2)
                        ->get();

         // yser details
        $user_det = DB::table('user_details')
                    ->select('*', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $id)
                    ->get();

         $current_goals = DB::table('user_goals')
                        ->select('*')
                        ->where('user_id', '=', $id)
                        ->limit(4)
                        ->get();

        //other's age/bday
       $query = "SELECT YEAR(CURDATE()) - YEAR(birthdate) - IF(STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(birthdate), '-', DAY(birthdate)) ,'%Y-%c-%e') > CURDATE(), 1, 0) AS age, civil_status, sex, address, profile_status, email_address, contact_no, school_workplace, emergency_contact, emergency_no, used_gym, occupation FROM user_details where user_id=".$id;         
        $profile = DB::select($query);     

         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');    

         $user_workout = DB::table('user_program')
                                ->select('day', 'point_status')
                                ->distinct('day')
                                ->where("user_id", "=", $id)
                                ->orderBy('day')
                                ->get();

        $user_achievement = DB::table('user_badge')
                            ->select('*')
                            ->join('badges', 'badges.id', '=', 'user_badge.badge_id')
                            ->where('user_id', '=', $id)
                            ->get();

        return view('member/viewprofile', compact('name_result', 'user_lvl', 'user_achievement', 'exp_date', 'profile', 'dp', 'name_result_other', 'notify_member', 'notify_system', 'exp_date_locker', 'user_det', 'current_goals', 'user_workout', 'user_achievement'));


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
