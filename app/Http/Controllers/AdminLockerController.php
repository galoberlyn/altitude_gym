<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class AdminLockerController extends Controller{
public function postForm()
    {   
    	$identifier = Input::get('identifier');   
        $lockerNumber = Input::get('lockers'); 


    $member = DB::table('user_details')
    ->select('user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status')
    ->leftJoin('user_record', 'user_record.id', '=', 'user_details.user_id')
    ->leftJoin('locker','user_details.user_id','=','locker.user_id')
    ->orderBy('user_details.first_name', 'asc')
    ->paginate(15);
    
    $memberLocker = DB::table('locker')
    ->select('status','locker_number')
    ->where('status','=','available')
    ->get();
    
    $user = DB::table('user_details')
    ->select('*')
    ->limit('10')
    ->get(); 
    
    $notification = DB::table('notifications')
    ->get(); 

    if(Input::get('rem')=='remover'){
	    DB::table('locker')
	    ->where('user_id', '=', Input::get('remove'))
	    ->update([
	        'user_id' => ' ',
	        'status' => 'available'
	    ]);
    }

    DB::table('locker')
    ->where('locker_number','=',$lockerNumber)
    ->update([
        'user_id' =>  $identifier,
        'status' => 'unavailable'
    ]);

    return view('admin/member', compact('member','user','notification','memberLocker'));
    }
}
?>