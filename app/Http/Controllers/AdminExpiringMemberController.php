<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_record;
use Carbon\Carbon;
use DB;

class AdminExpiringMemberController extends Controller
{

	public function index()
    {

        // $payments = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_log ON user.id = user_log.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE expiration_date <= curdate() AND status = 'unpaid'"); 
        $payments = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE payment_status = 'unpaid'  "); 
        $users = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");
        $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");


        return view ('admin/adminExpMem') ->with('payments', $payments)->with('users', $users)
                                        ->with('userCounts', $userCounts);

    }

    public function update(Request $request)
    {
        $user_record = new User_record;
        $user_record->user_id = $request-> input('user_id');
        $user_record->subscription = $request-> input('subscription');
        $user_record->date_subscription = Carbon::today();
        $user_record->expiration_date = Carbon::today()->addDays(30);
        $user_record->payment_status = 'paid';
        //$user_record->status = 'active';
        $user_record->amount = $request-> input('amount');
        $user_record->save();


        /*$date = Carbon::today()->addDays(30);


        DB::table('user_records')
        ->where('user_id', $user_record->user_id = $request-> input('user_id'))
        ->update(['expiration_date' => $date]);
        //update(['status' => 'paid']); */


        return redirect('admin/expiringMembership')->with('success', 'Added payment!');


    	/*$user_record->user_id = '400';
        $user_record->subscription = $request-> input('subscription');
        //$user_record->date_subscription = $request-> input('date_subscription');
        $user_record->date_subscription = Carbon::today();
        $user_record->expiration_date = Carbon::today()->addDays(30);
        $user_record->status = 'paid';
        $user_record->status = 'active';

        $user_record->save();

        return redirect('/expiringMembership')->with('success', 'User created!'); */

}
}
