<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Badge;
use Carbon\Carbon;
use DB;

class BadgeController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function index()
    {

        $current = Auth::id();
        
        $badges = DB::table('badges')->orderBy('id' , 'desc')->paginate(16);

        $user = DB::table('user_details')
        ->select('*')
        ->limit('10')
        ->get(); 
        
//get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        return view ('ManagerModule/managerAddBadge', compact('user', 'notification'))->with(['badges' => $badges]);
    }
    
    public function store(Request $request)
    {

        $current = Auth::id();

        $this->validate($request, [
         'badge_name' => 'required|unique:badges|max:255',
         'badge_description' => 'required|unique:badges|max:255',
			'image' => 'required|mimes:png|max:10240' // size in kelobytes this equals 10 mb
			
          ]);
        $xs =   DB::table('badges')
        ->orderBy('id', 'desc')
        ->value('id');

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        $badge = new Badge; 
        $badge->id = $xs+1;
        $badge->badge_name = $request-> input('badge_name');
        $badge->badge_description = $request-> input('badge_description');
        $badge->status = 'disabled';
        $badge->created_at = $current_time;
        $badge->updated_at = $current_time;
        
        $badge->save();
        
        $imageName = $badge->badge_name . '.' . 
        $request->file('image')->getClientOriginalExtension();

        $request->file('image')->move(
            base_path() . '/public/badges/', $imageName
            );

        $admin = DB::table('user')
        ->select('id')
        ->where('user_type' , '=' ,'admin')
        ->get();
        
        foreach($admin as $adm){

            DB::table('notifications')
            ->insert([
                'sender' => $current,
                'receiver' => $adm -> id,
                'message' => 'Manager added new badge!',
                'notification_type' => 'message',
                'read_at' => null,
                'created_at' => $current_time,
                'updated_at' => $current_time
                ]);
        }
        
        return back()->with('success', 'Badge Added Successfully!');
        
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

    public function disable_m(Request $request)
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

    public function enable_m(Request $request)
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
