<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Policy;
use DB;
use Carbon\Carbon;

class AdminGymPoliciesController extends Controller
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
        $allpoli = DB::table('policies')->where('category', 'Gym')->get();
        $policies = DB::table('policies')->where('type', 'Safety')->get();
        $policies1 = DB::table('policies')->where('type', 'Courtesy')->get();
        $policies2 = DB::table('policies')->where('type', 'Policies')->get();

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
        
        return view ('admin/gymPolicies')->with('notification', $notification)->with('allpoli', $allpoli)->with(['policies' => $policies])->with(['policies1' => $policies1])->with(['policies2' => $policies2]);
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
         return view ('admin/addGymPolicies')->with('notification', $notification);
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
             'type' => 'required|max:20',
             'policy_description' => 'required|max:50'
        ]);
        $policy = new Policy;
        $policy->category = $request-> input('category');
        $policy->type = trim($request-> input('type'));
        $policy->policy_description = trim($request-> input('policy_description'));
		$policy->created_at = Carbon::now();
        $policy->updated_at = Carbon::now();
        $policy->save();
        

        return redirect('/policies')->with('success', 'Gym Policy created!');
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
        return view('admin/editGymPolicies')->with('policy', $policy)->with('notification', $notification);;
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
        $policy->type = trim($request-> input('type'));
        $policy->policy_description = trim($request-> input('policy_description'));
		$policy->updated_at = Carbon::now();
        $policy->save();
        return redirect('/policies')->with('success', 'Policy edited!');
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
