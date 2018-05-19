<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
class MemberNotifController extends Controller
{
    //
    public function index(){
        
        $userId = Auth::id();
        
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();

        $all_manager = DB::table('user')
                        ->select('id')
                        ->where('user_type', '=', 'manager')
                        ->get();
        
        foreach($all_manager as $manager){

        $notify_member = DB::table('notifications')
                        ->select('*', DB::raw('DATE_FORMAT(notifications.created_at, "%b %d, %Y, %r") as date'))
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->where('receiver', '=', Auth::id())
                        ->where('sender', '=', $manager->id)
                        ->orderBy('notifications.id', 'desc')
                        ->paginate(8);
        }

        $notify_manager = DB::table('notifications')
                        ->select('*', DB::raw('DATE_FORMAT(notifications.created_at, "%b %d, %Y, %r") as date'))
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->join('user', 'notifications.sender', '=', 'user.id')
                        ->Where('receiver', '=', Auth::id())
                        ->where('notification_type', '=', 'message')
                        ->orderby('notifications.id', 'desc')

                        ->paginate(8);

                      

        $notify_system = DB::table('notifications')
                        ->select('*', DB::raw('DATE_FORMAT(notifications.created_at, "%b %d, %Y, %r") as date'))
                        ->where('receiver', '=', Auth::id())
                        ->where('notification_type', '=', 'System')
                        ->where('sender', '=', 'System')
                        ->orderBy('notifications.created_at', 'desc')
                        ->paginate(8);

        $notify_admin = DB::table('notifications')
                        ->select('*', DB::raw('DATE_FORMAT(notifications.created_at, "%b %d, %Y, %r") as date'))
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->join('user', 'notifications.sender', '=', 'user.id')
                        ->Where('receiver', '=', Auth::id())
                        ->where('user.user_type', '=', 'admin')
                        ->orderBy('notifications.created_at', 'desc')
                        ->paginate(8);

        $random_people = DB::table('user_details')
                        ->select('*', 'stats.user_id as idko')
                        ->limit(4)
                        ->join('user', 'user.id', '=', 'user_details.user_id' )
                        ->join('stats', 'user_details.user_id', '=', 'stats.user_id' )
                        ->where('user_type', '=', 'member')
                        ->where('user_details.user_id', '!=', Auth::id())
                        ->orderby(DB::raw('rand()'))
                        ->get();

         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');

        return view('member.member_notification', compact('name_result', 'notify_member', 'notify_system', 'notify_admin', 'random_people', 'exp_date_locker', 'notify_manager'));
    }

    public function clear(Request $request){

        DB::table('notifications')->where('receiver', '=', Auth::id())
        ->update([
            "read_at" => Carbon::now()
        ]);

        return redirect('/dashboard');
    }
}
