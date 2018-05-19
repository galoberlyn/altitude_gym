<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
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
use DB;
use Carbon\Carbon;

class AdminAssignBadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($badge_id)
    {
    $badge_name =   DB::table('badges')
                ->where('id', '=', $badge_id)
                ->value('badge_name');

   $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
    $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
    $daysdiffs = DB::select("SELECT count(datediff(curdate(), date_subscription)) as 'differencedays' FROM user INNER JOIN user_record ON user.id = user_record.user_id  where 'differencedays' <= 30 AND user_type = 'member'");
    $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
    $member = DB::table('user_details')
    ->select(DB::raw("DISTINCT `user_details`.`user_id`, `user_details`.`id`, `user_details`.`first_name`, `user_details`.`last_name`, 'avatar', GROUP_CONCAT(badge_name SEPARATOR ',') as 'earnbg'"))
    ->join('user', 'user_details.user_id', '=', 'user.id')
    ->join('user_record', 'user_record.id', '=', 'user_details.user_id')
    ->join('user_badge', 'user_details.user_id', '=', 'user_badge.user_id')
    ->join('badges', 'badges.id', '=', 'user_badge.badge_id')
    ->where('user_type', '=', 'member')
	->groupBy('user_details.user_id', 'first_name', 'last_name', 'user_details.id')
    ->orderBy('user_details.user_id', 'asc')
    ->paginate(15);
	
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
	
	$earned = DB::select("SELECT avatar, user_badge.user_id, first_name,last_name, GROUP_CONCAT(badge_name SEPARATOR ',') as earnbg FROM `user_badge` join badges on badges.id = user_badge.badge_id join user_details on user_badge.user_id = user_details.user_id join user on user.id = user_details.user_id where user_badge.user_id = user_badge.user_id  and user_type='member' group by user_badge.user_id, 1,2,3,4");
	
	
	$got_badge = 0;

    return view('admin/assignBadge', compact('badge_id', 'badge_name', 'member','user','notification','memberLocker','active_members', 'mems', 'exp_date', 'daysdiffs', 'earned', 'got_badge'));
    }

	
	    public function assign($badge_id, $user_id)
    {
    $badge_name =DB::table('badges')
                ->where('id', '=', $badge_id)
                ->value('badge_name');

    $first_name =DB::table('user_details')
                ->where('user_id', '=', $user_id)
                ->value('first_name');

    $last_name =DB::table('user_details')
                ->where('user_id', '=', $user_id)
                ->value('last_name');

      $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
    $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
    $daysdiffs = DB::select("SELECT count(datediff(curdate(), date_subscription)) as 'differencedays' FROM user INNER JOIN user_record ON user.id = user_record.user_id  where 'differencedays' <= 30 AND user_type = 'member'");
    $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
     $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

    $badges = DB::table('user_badge')
    ->select('*')
    ->leftJoin('badges', 'user_badge.badge_id', '=', 'badges.id')
    ->where('user_id', '=', $user_id)
    ->orderBy('date_achieved', 'desc')
    ->get();

    $got_badge = 0;


    //return $badges_array;
    return view('admin/badgeToUser', compact('badges', 'got_badge', 'badge_id', 'user_id', 'badge_name', 'first_name', 'last_name', 'member','user','notification','memberLocker','active_members', 'mems', 'exp_date', 'daysdiffs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification = DB::table('notifications')
        ->get();    
        return view ('admin/assignBadgeToUser')->with('notification', $notification);
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
		
		$date = Carbon::now();

		 DB::table('user_badge')
				->insert([
					"user_id" => $request-> input('user_id'),
					"badge_id" => $request-> input('badge_id'),
					"date_achieved" => $date,
					"created_at" => Carbon::now(),
					"updated_at" => Carbon::now()]);
					
		$uid = $request-> input('user_id');
		$baid = $request-> input('badge_id'); 
		$awardedmem= DB::select("SELECT user_id, badge_name from user_badge inner join badges on badges.id = user_badge.badge_id inner join user on user_badge.user_id = user.id where user_type = 'member' and user_id = $uid and badge_id = $baid ");
		foreach($awardedmem as $yay){
				$badge= $yay->badge_name;
			 DB::table('notifications')
				->insert([
					"sender" => Auth::id(),
					"receiver" => $yay->user_id,
					"message" => 'Congratulations! You have been awarded the '.$badge.' badge',
					"notification_type" => 'message',
					"read_at" => null,
					"created_at" => Carbon::now(),
					"updated_at" => Carbon::now()]);
		}

        return back()->with('success', 'Badge Awarded!');

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
    public function destroy($id)
    {
        //
    }

    public function searchFilter($badge_id, Request $request)
    {

    $badge_name =   DB::table('badges')
                ->where('id', '=', $badge_id)
                ->value('badge_name');

   $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
    $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
    $daysdiffs = DB::select("SELECT count(datediff(curdate(), date_subscription)) as 'differencedays' FROM user INNER JOIN user_record ON user.id = user_record.user_id  where 'differencedays' <= 30 AND user_type = 'member'");
    $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
    $searchBtn = Input::get('search');
    $member = DB::table('user_details')
    ->select(DB::raw("DISTINCT `user_details`.`user_id`, `user_details`.`id`, `user_details`.`first_name`, `user_details`.`last_name`, `user_record`.`subscription`"))
    ->join('user', 'user_details.user_id', '=', 'user.id')
    ->join('user_record', 'user_record.id', '=', 'user_details.user_id')
    ->join('user_badge', 'user_details.user_id', '=', 'user_badge.user_id')
    ->where('user_type', '=', 'member')
    ->where('user_details.last_name', '=', $searchBtn)
    ->orWhere('user_details.first_name', '=', $searchBtn)
    ->orWhere('user_record.subscription', '=', $searchBtn)
    ->orderBy('user_details.first_name', 'asc')
    ->paginate(15);
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
	
	$earned = DB::select("SELECT avatar, user_badge.user_id, first_name,last_name, GROUP_CONCAT(badge_name SEPARATOR ',') as earnbg FROM `user_badge` join badges on badges.id = user_badge.badge_id join user_details on user_badge.user_id = user_details.user_id join user on user.id = user_details.user_id where (first_name like '%$searchBtn%' or last_name like '%$searchBtn%') and (user_type = 'member') group by user_badge.user_id, 1,2,3,4");
	
	$got_badge = 0;

    return view('admin/assignBadge', compact('badge_id', 'badge_name', 'member','user','notification','memberLocker','active_members', 'mems', 'exp_date', 'daysdiffs','earned', 'got_badge'));
    }
}
