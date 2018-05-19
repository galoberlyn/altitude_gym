<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Policy;
use DB;
use Carbon\Carbon;  

class AdminGamePoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function index()
    {
        $gamepoli = DB::table('policies')->where('category', 'Gamification')->get();
		$points = DB::table('points')->limit('10')->get();

	    $user = DB::table('user_details')
	    ->select('*')
	    ->limit('10')
	    ->get();
        $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();  
		
        return view ('admin/gamePolicies')->with('notification', $notification)->with('gamepoli', $gamepoli)->with('points', $points);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
         return view ('admin/addGamePolicies')->with('notification', $notification);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		date_default_timezone_set('Asia/Manila');
        $this->validate($request, [
             'category' => 'required',
             'type' => 'required',
             'policy_description' => 'required'
        ]);
        $policy = new Policy;
        $policy->category = $request-> input('category');
        $policy->type = $request-> input('type');
        $policy->policy_description = $request-> input('policy_description');
        $policy->created_at = Carbon::now();
        $policy->updated_at = Carbon::now();
        // $policy->category =             'Gym';
        // $policy->type =                 'chest';
        // $policy->policy_description =   'thom yorke';
        // $policy->points =               20;
        $policy->save();
        

        return redirect('/gamification')->with('success', 'Gamification Policy created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $policy = Policy::find($id);
         $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
        return view('admin/editGamePolicies')->with('policy', $policy)->with('notification', $notification);
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
		date_default_timezone_set('Asia/Manila');
		
       $this->validate($request, [
             'category' => 'required',
             'type' => 'required',
             'policy_description' => 'required'
        ]);
        $policy = Policy::find($id);
        $policy->category = $request-> input('category');
        $policy->type = $request-> input('type');
        $policy->policy_description = $request-> input('policy_description');
		$policy->updated_at = Carbon::now();
        // $policy->category =             'Gym';
        // $policy->type =                 'chest';
        // $policy->policy_description =   'thom yorke';
        // $policy->points =               20;
        $policy->save();
        return redirect('/gamification')->with('success', 'Gamification Policy edited!');
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
