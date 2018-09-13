<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\User_detail;
use App\User_record;
use App\Stats;
use App\User_badge;
use DB;
use Carbon\Carbon;

class userController extends Controller {

    public function __construct() {
        $this->middleware('auth');

    }

    public function index() {

        $current = Auth::id();

    //get notification
        $notification = DB::table('notifications')
        ->select('*', 'notifications.id', 'notifications.created_at')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', $current)
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        return view ('ManagerModule/addMemberManager', compact('notification'));
    }


    public function store(Request $request) {

        $current = Auth::id();
        $checks = [
        'id_number' => 'required|unique:user',
        'first_name' => 'required|max:255|string',
        'middle_initial' => 'required|max:255|string',
        'last_name' => 'required|max:255|string',
        'birthdate' => 'required|date|before:2007-01-01',
        'sex' => 'required',
        'civil_status' => 'required',
        'address' => 'required|max:255',
        'contact_no' => 'required',
        'school_workplace' => 'required',
        'occupation' => 'required|string',
        'used_gym' => 'required',
        'emergency_contact' => 'required|max:255|string',
        'emergency_no' => 'required',
        'subscription' => 'required',
        'email_address' => 'required|email',
        'nickname' => 'required|max:255'
        ];

    //validate
        $this->validate($request, $checks);
        if ($request-> input('rfid_number') != "") {
            $this->validate($request, [
                'rfid_number' => 'unique:user'
                ]);
        }

    //add member
        $id = DB::table('user')
        ->orderBy('id', 'desc')
        ->value('id');

        $zone = date_default_timezone_set('Asia/Manila');
        $current_time = Carbon::now()->toDateTimeString();
        
        $user = new User;
        $user_detail = new User_detail;
        $user_record = new User_record;
        $stats = new Stats;
        $user_badge = new User_badge;

        $username = strtolower(str_replace(' ', '', $request -> input('first_name')).str_replace(' ', '', $request -> input('last_name')) .rand(1,999));

        $user->username = $username;
        $user->password = bcrypt('123456');
        $user->password_status = 'notset';
        $user->user_type = 'member';
        $user->id_number = $request-> input('id_number');
        $user->rfid_number = $request-> input('rfid_number');
        $user->avatar = "default.jpg";
        $user->created_at = $current_time;
        $user->updated_at = $current_time;

        $user->save();

        $ab = DB::table('user')
        ->orderBy('id', 'desc')
        ->value('id');

        $user_detail->user_id = $ab;
        $user_detail->first_name = trim($request-> input('first_name'));
        $user_detail->middle_initial = trim($request-> input('middle_initial'));
        $user_detail->last_name = trim($request-> input('last_name'));
        $user_detail->nickname = trim($request-> input('nickname'));
        $user_detail->birthdate = Carbon::createFromFormat('Y-m-d', $request->input('birthdate'));
        $user_detail->sex = $request-> input('sex');
        $user_detail->civil_status = $request-> input('civil_status');
        $user_detail->address = $request-> input('address');
        $user_detail->contact_no =  $request-> input('contact_no');
        $user_detail->email_address = $request-> input('email_address');
        $user_detail->school_workplace = $request-> input('school_workplace');
        $user_detail->occupation = $request-> input('occupation');
        $user_detail->used_gym = $request-> input('used_gym');
        $user_detail->medical_condition =  $request-> input('medical_condition');
        $user_detail->emergency_contact = $request-> input('emergency_contact');
        $user_detail->emergency_no =  $request-> input('emergency_no');
        $user_detail->profile_status = 'Public';
        $user_detail->created_at = $current_time;
        $user_detail->updated_at = $current_time;

        $user_record->user_id = $ab;
        $user_record->subscription = $request-> input('subscription');
        $user_record->amount = $request-> input('amount');
        $user_record->date_subscription = Carbon::createFromFormat('Y-m-d', $request->input('date_subscription')); 
        $user_record->expiration_date = Carbon::createFromFormat('Y-m-d', $request->input('date_subscription'))->addDays(30);
        $user_record->payment_status = 'paid';
        $user_record->status = 'active';
        $user_record->created_at = $current_time;
        $user_record->updated_at = $current_time;

        $stats->user_id = $ab;
        $stats->height = $request-> input('height');
        $stats->weight = $request-> input('weight');
        $stats->exp = '0';
        $stats->total_exp = '0';
        $stats->category = 'beginner';
        $stats->level = '1';
        $stats->created_at = $current_time;
        $stats->updated_at = $current_time;

        $user_badge->user_id = $ab;
        $user_badge->badge_id = 1;
        $user_badge->date_achieved = $current_time;
        $user_badge->created_at = $current_time;
        $user_badge->updated_at = $current_time;


        $user_detail->save();
        $user_record->save();
        $stats->save();
        $user_badge->save();

        $admin = DB::table('user')
        ->select('id')
        ->where('user_type' , '=' ,'admin')
        ->get();
        
        foreach($admin as $adm){

            DB::table('notifications')
            ->insert([
                'sender' => $current,
                'receiver' => $adm -> id,
                'message' => 'Manager added new user! Get payment from manager.',
                'notification_type' => 'message',
                'read_at' => null,
                'created_at' => $current_time,
                'updated_at' => $current_time
                ]);
        }

        
        return redirect('/addMember')->with('success', 'User created! Username:'.$username);
    }
}
