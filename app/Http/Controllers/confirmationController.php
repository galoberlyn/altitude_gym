<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use Auth;

class confirmationController extends Controller {

    public function index() {

        $current = Auth::id();

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

        $point_status = DB::table('userworkout_validation')
        ->select('*', 'userworkout_validation.created_at as create', 'userworkout_validation.id as iduniq', 'day_identifier')
        ->join('user_details', 'userworkout_validation.user_id', '=', 'user_details.user_id')
        ->join('user', 'user_details.user_id', '=', 'user.id')
        ->where('userworkout_validation.status', '=', 'for_validation')
        ->orderBy('userworkout_validation.user_id')
        ->paginate(15);

        $list_confirm = DB::table('userworkout_validation')
                ->distinct()
                ->select('userworkout_validation.user_id', 'first_name', 'last_name', 'type')
                ->join('user_details', 'user_details.user_id', '=', 'userworkout_validation.user_id')
                ->where('status', '=', "for_validation")
                ->get();

        $list_confirm_date = DB::table('userworkout_validation')
                            ->distinct()
                            ->select(DB::raw("date(created_at) as date2"), 'user_id')
                            ->get();

        return view ('ManagerModule/confirmation', compact('notification','exp_date','member','active_members','point_status', 'list_confirm', 'list_confirm_date'));

    }

    public function store() {

        $current = Auth::id();

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

        $point_status = DB::table('userworkout_validation')
        ->select('*', 'userworkout_validation.created_at as create', 'userworkout_validation.id as iduniq')
        ->join('user_details', 'userworkout_validation.user_id', '=', 'user_details.user_id')
        ->join('user', 'user_details.user_id', '=', 'user.id')
        ->where('userworkout_validation.status', '=', 'for_validation')
        ->orderBy('userworkout_validation.user_id')
        ->paginate(15);

        $list_confirm = DB::table('userworkout_validation')
                ->distinct()
                ->select('userworkout_validation.user_id', 'first_name', 'last_name', 'type')
                ->join('user_details', 'user_details.user_id', '=', 'userworkout_validation.user_id')
                ->where('status', '=', "for_validation")
                ->get();

        $list_confirm_date = DB::table('userworkout_validation')
                            ->distinct()
                            ->select(DB::raw("date(created_at) as date2"), 'user_id')
                            ->get();

        $current = Auth::id();

        //update to rendered
        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();

        $identifier = Input::get('identifier');  
        $day_identifier = Input::get('day_identifier'); 

        $rendered = DB::table('user_program')
        ->where('point_status','=','for_rendering')
        ->where('user_id', '=',  $identifier)
        ->where('day', '=', $day_identifier)
        ->where('row_status', '=', 'active')
        ->update([
            'point_status' => 'rendered',
            'updated_at' => $current_time
            ]);

         //change after update
        DB::table('userworkout_validation')
        ->where('user_id', '=', $identifier)
        ->where('day_identifier', '=', $day_identifier)
        ->update([
            "status" => "validated"]);

        DB::table('notifications')
        ->insert([
            'sender' => $current,
            'receiver' => $identifier,
            'message' => 'Your request has been approved!',
            'notification_type' => 'message',
            'read_at' => null,
            'created_at' => $current_time,
            'updated_at' => $current_time
            ]);

        return redirect('/confirmation')->with('success', 'Members request has been accepted!');

        return view ('ManagerModule/confirmation', compact('user', 'notification','exp_date','member','active_members','rendered','point_status', 'list_confirm', 'list_confirm_date'));


    }

    public function decline() {

     $current = Auth::id();

        //update to unrendered
     $zone = date_default_timezone_set('Asia/Manila');
     $current_time = Carbon::now()->toDateTimeString();

     $identifier = Input::get('identifier'); 
     $day_identifier = Input::get('day_identifier'); 
     $message = Input::get('mess'); 

     $unrendered = DB::table('user_program')
     ->where('point_status','=','for_rendering')
     ->where('user_id', '=',  $identifier)
     ->where('row_status', '=',  'active')
     ->where('day', '=', $day_identifier)
     ->update([
        'point_status' => 'unrendered',
        'workout_status' => 'on going',
        'updated_at' => $current_time
        ]);

        //delete after decline
     DB::table('userworkout_validation')
     ->where('user_id', '=', $identifier)
     ->where('day_identifier', '=', $day_identifier)
     ->update([
        "status" => "invalidated"]);


     DB::table('notifications')
     ->insert([
        'sender' => $current,
        'receiver' => $identifier,
        'message' => 'Your request has been declined! '.$message.'!',
        'notification_type' => 'message',
        'read_at' => null,
        'created_at' => $current_time,
        'updated_at' => $current_time
        ]);

     return redirect('/confirmation')->with('error', 'Members request has been declined!');

 }

 public function searchConfirm(Request $request) {

    $current = Auth::id();

    //search function
    $searchBtn = Input::get('search_for');

    $point_status = DB::table('userworkout_validation')
    ->select('*', 'userworkout_validation.created_at as create', 'userworkout_validation.id as iduniq')
    ->join('user_details', 'userworkout_validation.user_id', '=', 'user_details.user_id')
    ->join('user', 'user_details.user_id', '=', 'user.id')
    ->where('user_type', '=', 'member')
    ->where('userworkout_validation.status', '=', 'for_validation')
    ->where('first_name', 'like', $searchBtn .'%')
    ->orWhere('last_name', 'like', $searchBtn .'%')
    ->orWhere('userworkout_validation.created_at', 'like', '%' . $searchBtn .'%')
    ->orderBy('first_name')
    ->paginate(15);

    //get notification
    $notification = DB::table('notifications')
    ->select('*', 'notifications.id', 'notifications.created_at')
    ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
    ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
    ->where('receiver', '=', $current)
    ->where('read_at', '=', null)
    ->orderBy('notifications.created_at')
    ->get(); 

        //count expiring memberships
    $exp_date = DB::select("SELECT count(datediff(curdate(),expiration_date)) as 'expi', expiration_date from user_record INNER JOIN user ON user_record.user_id = user.id WHERE user_type = 'member' AND datediff(expiration_date, curdate()) <= 3 GROUP BY 'expi', expiration_date ORDER BY `expi`, expiration_date  ASC");

        //count members
    $member = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'");

        //count active members
    $active_members = DB::select("SELECT COUNT(status) as status from user_record INNER JOIN user ON user.id=user_record.user_id where status = 'active' AND user_type = 'member'");

    $list_confirm = DB::table('userworkout_validation')
                ->distinct()
                ->select('userworkout_validation.user_id', 'first_name', 'last_name', 'type')
                ->join('user_details', 'user_details.user_id', '=', 'userworkout_validation.user_id')
                ->where('status', '=', "for_validation")
                ->get();

        $list_confirm_date = DB::table('userworkout_validation')
                            ->distinct()
                            ->select(DB::raw("date(created_at) as date2"), 'user_id')
                            ->get();

    return view ('ManagerModule/confirmation', compact('notification','exp_date','member','active_members','point_status', 'list_confirm', 'list_confirm_date'));

}

public function sorting_confirm() {

    $current = Auth::id();

    $sortBtn = Input::get('sorting_confirm');
    $searchBtn = Input::get('search_for');

    $point_status = DB::table('userworkout_validation')
    ->select('*', 'userworkout_validation.created_at as create', 'userworkout_validation.id as iduniq')
    ->join('user_details', 'userworkout_validation.user_id', '=', 'user_details.user_id')
    ->join('user', 'user_details.user_id', '=', 'user.id')
    ->where('user_type', '=', 'member')
    ->where('userworkout_validation.status', '=', 'for_validation')
    ->where('first_name', 'like', $searchBtn .'%')
    ->orWhere('last_name', 'like', $searchBtn .'%')
    ->orderBy('first_name', $sortBtn)
    ->paginate(15);

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

    $list_confirm = DB::table('userworkout_validation')
                ->distinct()
                ->select('userworkout_validation.user_id', 'first_name', 'last_name', 'type')
                ->join('user_details', 'user_details.user_id', '=', 'userworkout_validation.user_id')
                ->where('status', '=', "for_validation")
                ->get();

        $list_confirm_date = DB::table('userworkout_validation')
                            ->distinct()
                            ->select(DB::raw("date(created_at) as date2"), 'user_id')
                            ->get();

    return view ('ManagerModule/confirmation', compact('point_status','notification', 'exp_date', 'users', 'available', 'member', 'active_members', 'list_confirm', 'list_confirm_date'));
}

public function accept_conf_name(Request $request){

    $user_id = $request -> input('accept_conf');
    $type_accept = $request -> input('conf_name');

    switch ($type_accept) {
        case 'Accept':
            # code...

        DB::table('userworkout_validation')->where('user_id', '=', $user_id)->where('status', '=', 'for_validation')
        ->update([
            "status" => "validated",
            "updated_at" => Carbon::now()
        ]);

        DB::table('user_program')->where('user_id', '=', $user_id)->where('point_status', '=', 'for_rendering')->where('row_status', '=', 'active')
        ->update([
            "point_status" =>  "rendered",
            "updated_at" => Carbon::now()
        ]);

         DB::table('notifications')
        ->insert([
            'sender' => Auth::id(),
            'receiver' => $user_id,
            'message' => 'Your request has been approved!',
            'notification_type' => 'message',
            'read_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]);

        return redirect('/confirmation')->with('success', 'Members request has been accepted!');


            break;
        
        case 'Decline':

        DB::table('userworkout_validation')->where('user_id', '=', $user_id)->where('status', '=', 'for_validation')
        ->update([
            "status" => "invalidated",
            "updated_at" => Carbon::now()
        ]);

        DB::table('user_program')->where('user_id', '=', $user_id)->where('point_status', '=', 'for_rendering')->where('row_status', '=', 'active')
        ->update([
            "point_status" =>  "unrendered",
            "workout_status" => "on going",
            "updated_at" => Carbon::now()
        ]);

         DB::table('notifications')
        ->insert([
            'sender' => Auth::id(),
            'receiver' => $user_id,
            'message' => 'Your request has been declined!',
            'notification_type' => 'message',
            'read_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]);

        return redirect('/confirmation')->with('error', 'Members request has been declined!');


            break;

    }
}

public function accept_conf_date(Request $request){

    $date = $request -> input('accept_conf_date');
    $type_accept = $request -> input('conf_name');

    switch ($type_accept) {
        case 'Accept':
            # code...

        $users = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");

        DB::update("UPDATE userworkout_validation set status='validated', updated_at='".Carbon::now()."' where date(created_at) = '".$date."'");
        
        DB::update("UPDATE user_program set point_status='rendered', updated_at='".Carbon::now()."' where date(created_at) = '".$date."' and  row_status='active'");


        return redirect('/confirmation')->with('success', 'Members request has been accepted!');


            break;
        
        case 'Decline':

         DB::update("UPDATE userworkout_validation set status='invalidated', updated_at='".Carbon::now()."' where date(created_at) = '".$date."'");
        
        DB::update("UPDATE user_program set point_status='unrendered', updated_at='".Carbon::now()."' where date(created_at) = '".$date."' and row_status = 'active'");



        return redirect('/confirmation')->with('error', 'Members request has been declined!');


            break;

    }
    

}
}
