<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Badge;
use DB;
use Carbon\Carbon; 

class AdminAddBadgeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
	 public function create()
    {
        return view ('admin\adminAddBadge');
    }
	
	public function index()
    {
    $badges = DB::table('badges')->orderBy('id', 'desc')->get();

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
		
    return view ('admin/adminAddBadge', compact('user', 'notification'))->with(['badges' => $badges]);
    }
	
    public function store(Request $request)
    {
		date_default_timezone_set('Asia/Manila');
		
       $this->validate($request, [
			'badge_name' => 'required|unique:badges|max:255',
			'badge_description' => 'required|unique:badges|max:255',
			'image' => 'required|mimes:png|max:10240' // size in kelobytes this equals 10 mb
			
		]);
        $xs =   DB::table('badges')
                ->orderBy('id', 'desc')
                ->value('id');
		// $xs = DB::select("SELECT (user_id+1) AS user_id FROM `user_details` ORDER BY 1 DESC LIMIT 1")->value('user_id');
		$badge = new Badge; 
		$badge->id = $xs+1;
		$badge->badge_name = $request-> input('badge_name');
		$badge->badge_description = $request-> input('badge_description');
		$badge->status = 'active';
		
		$badge->save();
		
		$imageName = $badge->badge_name . '.' . 
        $request->file('image')->getClientOriginalExtension();

    $request->file('image')->move(
        base_path() . '/public/badges/', $imageName
    );
		
        // $payments->user_id = '400';
        // $payments->payment_date = '2018-01-25';
        // $payments->payment_type = $request-> input('payment_type');
        // $user_record->date_subscription = Carbon::createFromFormat('Y-m-d', $request->input('date_subscription'));
		
		$allmem= DB::select("SELECT id from user where not user_type = 'admin'");
		foreach($allmem as $users){

			 DB::table('notifications')
				->insert([
					"sender" => Auth::id(),
					"receiver" => $users->id,
					"message" => 'Hello! A new badge is available. Go check it out now!',
					"notification_type" => 'message',
					"read_at" => null,
					"created_at" => Carbon::now(),
					"updated_at" => Carbon::now()]);
		}
		
		return back()->with('success', 'Success! Badge Added');
		
		//return 'i got loyalty got royalty inside my dna';
    }
	
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
    public function disable(Request $request)
    {
		date_default_timezone_set('Asia/Manila');
		
		$bid = $request->input('badge_id');
		
		$badge = DB::table('badges')->where('id', '=', $bid)->first();
		
		$badgeid = $badge->id;
		$status = 'disabled';
		$updated = $badge->updated_at;
		
		$date = Carbon::now();
		
		DB::table('badges')
				->where('id','=',$bid)
				->update(['status' => $status,'updated_at' => $updated]);
		
        return back()->with('success', 'Badge Disabled!');

    }

	public function enable(Request $request)
    {
		date_default_timezone_set('Asia/Manila');
		
		$bid = $request->input('badge_id');
		
		$badge = DB::table('badges')->where('id', '=', $bid)->first();
		
		$badgeid = $badge->id;
		$status = 'active';
		$updated = $badge->updated_at;
		
		$date = Carbon::now();
		
		DB::table('badges')
				->where('id','=',$bid)
				->update(['status' => $status,'updated_at' => $updated]);
		
        return back()->with('success', 'Badge Activated!');

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
