<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
class MemberGamifiedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gamiPolicy = DB::table('policies')
            ->select('policy_description')
            ->where('category', '=', 'Gamification')
            ->get();
        $userId = Auth::id();
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();
        
        $gamepoli = DB::table('policies')
           ->select('policy_description')
            ->where('category', '=', 'Gamification')
            ->get();
        
        $points = DB::table('points')
            ->get();

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
                        ->where('sender', '=', 'System')
                        ->where('read_at', '=', NULL)
                        ->orderBy('notifications.id', 'desc')
                        ->limit(2)
                        ->get();

         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');

        $badges = DB::table('badges')
                ->select('*')
                ->get();


     return view('member/gamified', compact('gamiPolicy', 'name_result', 'gamepoli', 'points', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker', 'badges'));

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
