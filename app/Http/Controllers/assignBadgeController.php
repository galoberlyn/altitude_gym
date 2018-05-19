<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use Auth;
use App\User;
use App\User_detail;
use App\User_record;
use App\User_badge;
use App\Payments;
use App\Stats;
use App\Points;
use App\Badge;
use Excel;

class assignBadgeController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');

    }
    
    function index($badge_id){

        $current = Auth::id();

        //get member details
        $badge_name =   DB::table('badges')
        ->where('id', '=', $badge_id)
        ->value('badge_name');

        $memberSearch = DB::table('user_details')
        ->select('*')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->where('user_type', '=', 'member')
        ->orderBy('user_id')
        ->paginate(15);

        $membadge = DB::table('user_badge')
        ->select('*')
        ->leftJoin('badges', 'badges.id', '=', 'user_badge.badge_id')
        ->orderBy('user_id')
        ->get();

    	//count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

//get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        //auto change status to inactive
        $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 


        return view ('ManagerModule/assignBadge', compact('badge_id', 'badge_name','memberSearch' , 'notification','exp_date','member','active_members','inactive','membadge'));

    }

    public function search_b(Request $request , $badge_id) {

        $current = Auth::id();

        $badge_name =   DB::table('badges')
        ->where('id', '=', $badge_id)
        ->value('badge_name');

        //search memeber
        $searchBtn = Input::get('search_b');
        
        $memberSearch = DB::table('user_details')
        ->select('*')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('user_details.user_id', '=', $searchBtn)
        ->orderBy('user_details.first_name')
        ->paginate(15);

        $membadge = DB::table('user_badge')
        ->select('*')
        ->leftJoin('badges', 'badges.id', '=', 'user_badge.badge_id')
        ->orderBy('user_id')
        ->get();

        //get locker
        $memberLocker = DB::table('locker')
        ->select('status','locker_number')
        ->where('status','=','available')
        ->get();

//get notification
        $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        //auto change status to inactive
        $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");
        
        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");


        return view ('ManagerModule/assignBadge', compact('memberSearch','notification','memberLocker', 'exp_date', 'users', 'available', 'inactive', 'member', 'active_members','badge_name','badge_id','membadge'));
    }

    public function sorting(Request $request , $badge_id) {

        $current = Auth::id();

        $badge_name =   DB::table('badges')
        ->where('id', '=', $badge_id)
        ->value('badge_name');

        $sortBtn = Input::get('sorting');
        $searchBtn = Input::get('search');
        
        $memberSearch = DB::table('user_details')
        ->select('*')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->where('user_type', '=', 'member')
        ->orderBy('first_name', $sortBtn)
        ->paginate(15);

        $membadge = DB::table('user_badge')
        ->select('*')
        ->leftJoin('badges', 'badges.id', '=', 'user_badge.badge_id')
        ->orderBy('user_id')
        ->get();

        //get locker
        $memberLocker = DB::table('locker')
        ->select('status','locker_number')
        ->where('status','=','available')
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

        //auto change status to inactive
        $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");
        
        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'"); 

        return view ('ManagerModule/assignBadge', compact('memberSearch','notification','memberLocker', 'exp_date', 'users', 'available', 'inactive', 'member', 'active_members','badge_name','badge_id','membadge'));
    }

    public function store($badge_id) {

        $current = Auth::id();

        $badge_name =   DB::table('badges')
        ->where('id', '=', $badge_id)
        ->value('badge_name');

        //count expiring memberships
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

//get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        $memberSearch = DB::table('user_details')
        ->select('*')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->orderBy('user_id')
        ->where('user_type', '=', 'member')
        ->paginate(15);

        $membadge = DB::table('user_badge')
        ->select('*')
        ->leftJoin('badges', 'badges.id', '=', 'user_badge.badge_id')
        ->orderBy('user_id')
        ->get();

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        $identifier = Input::get('identifier');
        $badge = Input::get('badge');

        $mbadge = DB::table('user_badge')
        ->select('badge_id')
        ->where('user_id', '=', $identifier)
        ->get();  

        foreach (array($mbadge) as $mbg) {
            
            if((strpos($mbg, $badge) == true)){

                return redirect('/assignBadge/'.$badge_id)->with('error', 'Badge has already been awarded to user!');
                
            }else{

                $assign = DB::table('user_badge')->insert([
                   ['user_id' => $identifier, 'badge_id' => $badge, 'date_achieved' => $current_time, 'created_at' => $current_time, 'updated_at' => $current_time]

                   ]);

                $admin = DB::table('user')
                ->select('id')
                ->where('user_type' , '=' ,'admin')
                ->get();
                
                foreach($admin as $adm){

                    DB::table('notifications')
                    ->insert([
                        'sender' => $current,
                        'receiver' => $adm -> id,
                        'message' => 'Manager assigned badge to user!',
                        'notification_type' => 'message',
                        'read_at' => null,
                        'created_at' => $current_time,
                        'updated_at' => $current_time
                        ]);

                    Db::table('notifications')
                    ->insert([
                        'sender' => $current,
                        'receiver' => $identifier,
                        'message' => 'You had earned a badge!',
                        'notification_type' => 'message',
                        'read_at' => null,
                        'created_at' => $current_time,
                        'updated_at' => $current_time
                        ]);
                }
                return redirect('/assignBadge/'.$badge_id)->with('success', 'Badge awarded to user!');
            }
        }
        return view ('ManagerModule/assignBadge', compact('user', 'notification','exp_date','member','active_members','rendered','memberSearch','assign','membadge','badge_id','badge_name'));

    }

    public function show($id){

    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 }
