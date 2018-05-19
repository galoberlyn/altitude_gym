<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class AdminSearchFilterController extends Controller
{
public function searchFilter(Request $request)
    {

    $sortBtn = $request -> input('sort');
    $searchBtn = $request -> input('search');

    $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");
    $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");


    $memberLocker = DB::table('locker')
    ->select('status','locker_number')
    ->where('status','=','available')
    ->get();
    
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

    $member = DB::table('user_details')
    ->select('user.avatar','user.username','user_details.user_id','user.id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status')
    ->leftJoin('user_record', 'user_record.id', '=', 'user_details.user_id')
    ->leftJoin('locker','user_details.user_id','=','locker.user_id')
    ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
    ->orderBy('user_details.first_name', $sortBtn)
    ->where('first_name','like','%'.$searchBtn.'%')
    ->orWhere('last_name','like','%'.$searchBtn.'%')
    ->orWhere('locker_number','like','%'.$searchBtn.'%')
    ->orWhere('subscription','like','%'.$searchBtn.'%')
    ->orWhere('user.username', 'like', $searchBtn .'%')
    ->paginate(15);

    $admin_distinct = DB::table('locker')
        ->distinct('locker_set')
        ->select('locker_set')
        ->get();

    $memLocker = DB::table('locker')
    ->select('locker_number','locker.status', 'first_name', 'last_name', 'avatar')
    ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
    ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
    ->orderBy('locker.id')
    ->get();

    return view('admin/member', compact('member','user','notification','memberLocker','userCounts','exp_date','mems','active_members','admin_distinct','memLocker'));
    }
}
?>