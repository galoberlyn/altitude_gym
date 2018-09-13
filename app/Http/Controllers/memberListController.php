<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;

class memberListController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');

    }
    
    function index() {

        $current = Auth::id();

        //auto update member status to inactive
        $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30");

        //auto update member payment_status to unpaid
        $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `payment_status` = 'unpaid' WHERE datediff(curdate(), date_subscription) >= 30"); 
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");


        //get member details
        $memberSearch = DB::table('user_details')
        ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status', 'user.user_type', 'user.avatar', 'user.username')
        ->leftJoin('user_record', 'user_record.user_id', '=', 'user_details.user_id')
        ->leftJoin('locker','user_details.user_id','=','locker.user_id')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->orderBy('user_details.first_name')
        ->where('user_type', '=', 'member')
        ->paginate(15);

        //get locker status
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

        $managerLocker = DB::table('locker')
        ->select('locker_number','locker.status', 'first_name', 'last_name', 'avatar')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->orderBy('locker.id')
        ->get();

        $manager_distinct = DB::table('locker')
        ->distinct('locker_set')
        ->select('locker_set')
        ->get();


        return view ('ManagerModule/memberListManager1', compact('memberSearch', 'notification','memberLocker', 'exp_date','inactive','exp_date','member','active_members','notification','managerLocker','unpaid', 'manager_distinct'));

    }

    public function searchMember(Request $request) {

        $current = Auth::id();
        
        //search function
        $searchBtn = Input::get('searching');

        $memberSearch = DB::table('user_details')
        ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status', 'user.avatar', 'user.username')
        ->leftJoin('user_record', 'user_record.user_id', '=', 'user_details.user_id')
        ->leftJoin('locker','user_details.user_id','=','locker.user_id')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('first_name', 'like', $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('last_name', 'like', $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('locker_number', '=', $searchBtn)
        ->where('user_type', '=', 'member')
        ->orWhere('subscription', 'like', $searchBtn .'%')
        ->where('user_type', '=', 'member')
        ->orWhere('user_record.status', 'like', $searchBtn .'%')
        ->orderBy('user_details.first_name')
        ->paginate(15);

        //get locker status
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

        //auto update member status to inactive
            $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 

        //auto update member payment_status to unpaid
            $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `payment_status` = 'unpaid' WHERE datediff(curdate(), date_subscription) >= 30"); 

        //count expiring membership
            $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
            $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
            $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where user_type = 'member' AND status = 'active'");

            $managerLocker = DB::table('locker')
            ->select('locker_number','locker.status', 'first_name', 'last_name', 'avatar')
            ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
            ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
            ->orderBy('locker.id')
            ->get();

            $manager_distinct = DB::table('locker')
            ->distinct('locker_set')
            ->select('locker_set')
            ->get();

            return view ('ManagerModule/memberListManager1', compact('memberSearch','notification','memberLocker', 'exp_date', 'users', 'available', 'inactive', 'member', 'active_members','managerLocker','unpaid', 'manager_distinct'));
        }

        public function member() {

            $current = Auth::id();

        //get member details
            $memberSearch = DB::table('user_details')
            ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status', 'user.user_type','user.avatar', 'user.username')
            ->leftJoin('user_record', 'user_record.user_id', '=', 'user_details.user_id')
            ->leftJoin('locker','user_details.user_id','=','locker.user_id')
            ->leftJoin('user','user.id', '=', 'user_details.user_id')
            ->orderBy('user_details.first_name')
            ->where('user_type', '=', 'member')
            ->paginate(15);

        //get locker status
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

        //auto update member status to inactive
            $inactive = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `status` = 'inactive' WHERE datediff(curdate(), date_recorded) >= 30"); 

        //auto update member payment_status to unpaid
            $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `payment_status` = 'unpaid' WHERE datediff(curdate(), date_subscription) >= 30"); 

        //count expiring membership
            $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
            $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
            $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

        //
            $user = DB::table('user_details')
            ->select('*')
            ->limit('10')
            ->get(); 

            $managerLocker = DB::table('locker')
            ->select('locker_number','locker.status', 'first_name', 'last_name', 'avatar')
            ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
            ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
            ->orderBy('locker.id')
            ->get();

            $manager_distinct = DB::table('locker')
            ->distinct('locker_set')
            ->select('locker_set')
            ->get();


            return view('ManagerModule/memberListManager1', compact('memberSearch','user','notification','memberLocker', 'inactive','exp_date','member','active_members','managerLocker','unpaid', 'manager_distinct'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sorting_m() {

        $current = Auth::id();

        $sortBtn = Input::get('sorting_m');
        $searchBtn = Input::get('search');
        $memberSearch = DB::table('user_details')
        ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status', 'user.avatar', 'user.username')
        ->leftJoin('user_record', 'user_record.user_id', '=', 'user_details.user_id')
        ->leftJoin('user', 'user_details.user_id', '=', 'user.id')
        ->leftJoin('locker','user_details.user_id','=','locker.user_id')
        ->where ('user.user_type', '=', 'member')
        ->orderBy('user_details.first_name', $sortBtn)
        ->paginate(15);


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

        //auto update member payment_status to unpaid
        $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_log` ON user.id = user_log.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `payment_status` = 'unpaid' WHERE datediff(curdate(), date_subscription) >= 30");  
        
        //count expiring membership
        $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");
        
        //count members
        $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
        $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'"); 

        $managerLocker = DB::table('locker')
        ->select('locker_number','locker.status', 'first_name', 'last_name', 'avatar')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->orderBy('locker.id')
        ->get();

        $manager_distinct = DB::table('locker')
        ->distinct('locker_set')
        ->select('locker_set')
        ->get();

        return view ('ManagerModule/memberListManager1', compact('memberSearch','notification','memberLocker', 'exp_date', 'users', 'available', 'inactive', 'member', 'active_members','managerLocker','unpaid','manager_distinct'));
    }

    public function postForm() {

        $current = Auth::id();

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        //assign locker   
        $identifier = Input::get('identifier');   
        $lockerNumber = Input::get('lockers'); 


        $assign = DB::table('locker')
        ->where('locker_number','=',$lockerNumber)
        ->update([
            'user_id' =>  $identifier,
            'status' => 'unavailable',
            'updated_at' => $current_time,
            'date_subscription' => Carbon::today(),
            'date_expiry' => Carbon::today()->addDays(30),
            'updated_at' => $current_time
            ]);

        DB::table('payments')
        ->insert([
            'user_id' => $identifier,
            'payment_date' => $current_time,
            'payment_type' => 'locker',
            'amount' => 180,
            'created_at' => $current_time,
            'updated_at' => $current_time
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
                'message' => 'Manager assigned locker to user !',
                'notification_type' => 'message',
                'read_at' => null,
                'created_at' => $current_time,
                'updated_at' => $current_time
                ]);
        }


        return redirect('/members_m')->with('success', 'Locker Assigned!');

    }


    public function postBtn() {

        $current = Auth::id();

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        //remove locker
        DB::table('locker')
        ->where('user_id', '=', Input::get('available'))
        ->update([
            'user_id' => ' ',
            'status' => 'available',
            'date_subscription' => '1970-01-01 00:00:00',
            'date_expiry' => '1970-01-01 00:00:00',
            'updated_at' => $current_time
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
                'message' => 'Manager unassigned locker to user!',
                'notification_type' => 'message',
                'read_at' => null,
                'created_at' => $current_time,
                'updated_at' => $current_time
                ]);
        }

        return redirect('/members_m')->with('error', 'Locker Unassigned!');
    }

    public function addLocker() {

        $current = Auth::id();

        $get_lock = DB::table('locker')->select('locker_set')->get();

        $last_record = DB::table('locker')->orderBy('id', 'desc')->first();
        $rem_char = preg_replace("/[^0-9,.]/", "", $last_record->locker_number);

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

         //assign locker   
        $set = Input::get('set'); 
        $lock_num = Input::get('lock_num');

        if ($lock_num > 30) {

            return redirect('/members_m')->with('error', 'Maximum per set is 30 lockers!');

        } else {

            if($last_record->locker_number !== $last_record->locker_set.'30'){

                if($lock_num + $rem_char <= 30) {

                    if($set == $last_record->locker_set){

                        for($c=$rem_char+1;$c < $rem_char+$lock_num+1;$c++){

                            $addlock = DB::table('locker')
                            ->insert([
                                ['user_id' => ' ' , 'locker_number' => $last_record->locker_set.$c, 'locker_set' => $last_record->locker_set , 'date_subscription' => '1970-01-01 00:00:00' , 'date_expiry' => '1970-01-01 00:00:00' , 'status' => 'available' , 'created_at' => $current_time , 'updated_at' => $current_time]

                                ]);
                        }
                        return redirect('/members_m')->with('success', 'Added lockers to set!');
                    }else{

                        for($a=$rem_char+1;$a < $rem_char+$lock_num+1;$a++){

                            $addlock = DB::table('locker')
                            ->insert([
                                ['user_id' => ' ' , 'locker_number' => $last_record->locker_set.$a, 'locker_set' => $last_record->locker_set , 'date_subscription' => '1970-01-01 00:00:00' , 'date_expiry' => '1970-01-01 00:00:00' , 'status' => 'available' , 'created_at' => $current_time , 'updated_at' => $current_time]

                                ]);
                        }
                        return redirect('/members_m')->with('error', 'Last locker set should atleast have 30 lockers! Added lockers to last set.');
                    }

                }else{

                    return redirect('/members_m')->with('error', 'Maximum per set is 30 lockers! Please fill out first the latest set!');

                }

            }else{ 

                $lock_set = DB::table('locker')
                ->select('locker_set')
                ->groupby('locker_set')
                ->get();

                if(strpos($lock_set, $set) == false){


                    for($l=1;$l<$lock_num+1;$l++){
                        $addlock = DB::table('locker')
                        ->insert([
                            ['user_id' => ' ' , 'locker_number' => $set.$l, 'locker_set' => $set , 'date_subscription' => '1970-01-01 00:00:00' , 'date_expiry' => '1970-01-01 00:00:00' , 'status' => 'available' , 'created_at' => $current_time , 'updated_at' => $current_time]

                            ]);
                    }
                    return redirect('/members_m')->with('success', 'Added Locker Set!');            

                }else{

                    return redirect('/members_m')->with('error', 'Locker set already exists!');


                }


            }

            $admin = DB::table('user')
            ->select('id')
            ->where('user_type' , '=' ,'admin')
            ->get();

            foreach($admin as $adm){

                DB::table('notifications')
                ->insert([
                    'sender' => $current,
                    'receiver' => $adm -> id,
                    'message' => 'Manager added Locker!',
                    'notification_type' => 'message',
                    'read_at' => null,
                    'created_at' => $current_time,
                    'updated_at' => $current_time
                    ]);
            }
        }
        

    }
}

