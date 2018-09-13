<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\User_detail;
use App\User_log;
use Excel;
use DB;

use Carbon\Carbon;  

class AdminUserLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function index()
    {
		 date_default_timezone_set('Asia/Manila');
        $date = Carbon::parse(Carbon::now())->format('Y-m-d');
        $dates = DB::select("SELECT DISTINCT date_recorded, CURDATE() as now FROM `user_log` ORDER BY date_recorded DESC ");
      
		
        $admin_distinct = DB::table('locker')
        ->distinct('locker_set')
        ->select('locker_set')
        ->get();
   $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
        $users = DB::table("user")
        ->select('*')
        ->join('user_log','user.id','=','user_log.user_id')
        ->join('user_details','user.id','=','user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('date_recorded', '=', $date)
        ->orderBy('user_log.time_in', 'ASC')
        ->paginate(15);

        DB::select("SELECT * FROM user INNER JOIN user_log ON user.id = user_log.user_id INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member' ORDER BY time_in DESC" );
        $just_users = DB::select("SELECT DISTINCT * FROM user INNER JOIN user_log ON user.id = user_log.user_id ORDER BY time_in DESC" );
        $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member'");
            $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();



        return view ('admin/memberLogAdmin') 
                                        ->with('dates', $dates)
                                        ->with('users', $users)
                                        ->with('mems', $mems)
                                        ->with('daysdiffs', $daysdiffs)
                                        ->with('exp_date', $exp_date)
                                        ->with('active_members', $active_members)
                                        ->with('userCounts', $userCounts)
                                        ->with('notification', $notification)
                                        ->with('dates', $dates);
    }

    public function searchFilterToday(Request $request)
    {
        $searchBtn = Input::get('search');
       $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
        $date = Carbon::parse(Carbon::now())->format('Y-m-d');
        $dates = DB::select("SELECT DISTINCT date_recorded, CURDATE() as now FROM `user_log` ORDER BY date_recorded DESC ");
        $users = DB::table("user")
        ->select('*')
        ->join('user_log','user.id','=','user_log.user_id')
        ->join('user_details','user.id','=','user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('date_recorded', '=', $date)
        ->where('first_name','=',$searchBtn)
        ->orWhere('last_name','=',$searchBtn)
        ->orWhere('time_in','=',$searchBtn)
        ->orWhere('time_out','=',$searchBtn)
        ->where('user_type', '=', 'member')
        ->orderBy('user_log.time_in', 'ASC')
        ->paginate(15);

        DB::select("SELECT * FROM user INNER JOIN user_log ON user.id = user_log.user_id INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member' ORDER BY time_in DESC" );
        $just_users = DB::select("SELECT DISTINCT * FROM user INNER JOIN user_log ON user.id = user_log.user_id ORDER BY time_in DESC" );
        $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member'");
                    $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();

        return view ('admin/memberLogAdmin') 
                                        ->with('dates', $dates)
                                        ->with('users', $users)
                                        ->with('userCounts', $userCounts)
                                        ->with('daysdiffs', $daysdiffs)
                                        ->with('exp_date', $exp_date)
                                        ->with('mems', $mems)
                                        ->with('active_members', $active_members)
                                        ->with('userCounts', $userCounts)
                                        ->with('notification', $notification)
                                        ->with('dates', $dates);
    
    }

    public function searchFilterSpec($date_of_search, Request $request)
    {
        $selected_date = $date_of_search;
        $searchBtn = Input::get('search');
        $dates = DB::select("SELECT DISTINCT date_recorded, CURDATE() as now FROM `user_log` ORDER BY date_recorded DESC ");
$active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
		$users = DB::table("user")
        ->select('*')
        ->join('user_log','user.id','=','user_log.user_id')
        ->join('user_details','user.id','=','user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('date_recorded', '=', $selected_date)
        ->where('user_details.first_name', '=', $searchBtn)
        ->orWhere('user_details.last_name', '=', $searchBtn)
        ->orderBy('user_log.time_in', 'ASC')
        ->paginate(15);
        $just_users = DB::select("SELECT DISTINCT * FROM user INNER JOIN user_log ON user.id = user_log.user_id" );
        $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member'");
                    $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 
        return view ('admin/memberLogSpecific')
                                        ->with('selected_date', $selected_date)
                                        ->with('dates', $dates)
                                        ->with('users', $users)
                                        ->with('userCounts', $userCounts)
                                        ->with('notification', $notification)
                                        ->with('dates', $dates)
										 ->with('daysdiffs', $daysdiffs)
                                        ->with('exp_date', $exp_date)
                                        ->with('mems', $mems)
                                        ->with('active_members', $active_members);
    }

    public function view_at_date($id)
    {

        $selected_date = $id;
        $dates = DB::select("SELECT DISTINCT date_recorded, CURDATE() as now FROM `user_log` ORDER BY date_recorded DESC ");
               $active_members = DB::select("SELECT COUNT(status) as status from user_record where status = 'active'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
		$users = DB::table("user")
        ->select('*')
        ->join('user_log','user.id','=','user_log.user_id')
        ->join('user_details','user.id','=','user_details.user_id')
        ->where('user_type', '=', 'member')
        ->where('date_recorded', '=', $selected_date)
        ->orderBy('user_log.time_in', 'ASC')
        ->paginate(15);
        $just_users = DB::select("SELECT DISTINCT * FROM user INNER JOIN user_log ON user.id = user_log.user_id" );
        $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member'");
                    $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

        return view ('admin/memberLogSpecific')
                                        ->with('selected_date', $selected_date)
                                        ->with('dates', $dates)
                                        ->with('users', $users)
                                        ->with('userCounts', $userCounts)
                                        ->with('notification', $notification)
                                        ->with('dates', $dates)
										 ->with('daysdiffs', $daysdiffs)
                                        ->with('exp_date', $exp_date)
                                        ->with('mems', $mems)
                                        ->with('active_members', $active_members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selected_date = $id;
        $dates = DB::select("SELECT DISTINCT date_recorded, CURDATE() as now FROM `user_log` ORDER BY date_recorded DESC ");
        $users = DB::select("SELECT * FROM user INNER JOIN user_log ON user.id = user_log.user_id INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member' ORDER BY time_in DESC" );
        $just_users = DB::select("SELECT DISTINCT * FROM user INNER JOIN user_log ON user.id = user_log.user_id" );
        $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member'");
                    $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
        return view ('admin/memberLogSpecific')->with('selected_date', $selected_date)
                                        ->with('dates', $dates)
                                        ->with('users', $users)
                                        ->with('userCounts', $userCounts)
                                        ->with('notification', $notification)
                                        ->with('dates', $dates);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    //  */
    //  public function edit($id)
    // {

    // }
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

    public function searchFilter(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric|digits:4'
        ]);
        $year = Input::get('year');
        $month = Input::get('month');
        $day = Input::get('day');
        return redirect('/log/view_at_date/'."$year".'-'."$month".'-'."$day")->with('success', 'Showing member log for '.$year.'-'.$month.'-'.$day);
    }

    public function memberArchive()
    {
        $dates = DB::table('user_log')
            ->select(DB::raw("DISTINCT date_recorded, CURDATE() as now"))
            ->orderBy('date_recorded', 'DESC')
            ->paginate(15);

        $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member'");
       $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 

        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
                    $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
        return view ('admin/memberLogArchive')->with('dates', $dates)
                                        ->with('mems', $mems)
                                        ->with('userCounts', $userCounts)
                                        ->with('exp_date', $exp_date)
                                        ->with('notification', $notification)
                                        ->with('active_members', $active_members);
    }

    public function prepareLogExport(Request $request){
        $print_1 = Input::has('1-selected') ? true : false;
        $print_2 = Input::has('2-selected') ? true : false;
        $print_3 = Input::has('3-selected') ? true : false;
        $print_4 = Input::has('4-selected') ? true : false;
        $print_5 = Input::has('5-selected') ? true : false;
        $print_6 = Input::has('6-selected') ? true : false;
        $year = Input::get('year');
        $month = Input::get('month');
        $day = Input::get('day');
        return redirect()->route('log-export')->with('print_1', $print_1)->with('print_2', $print_2)->with('print_3', $print_3)->with('print_4', $print_4)->with('print_5', $print_5)->with('print_6', $print_6)->with('year', $year)->with('month', $month)->with('day', $day);
    }

    public function logExport()
    {
        $print = array();
        $generate = false;
        if (session('print_1')) {array_push($print, 'user_log.date_recorded AS Log Date');}
        if (session('print_2')) {array_push($print, "user_details.user_id AS Member's ID");}
        if (session('print_3')) {array_push($print, 'user_details.first_name AS First Name');}
        if (session('print_4')) {array_push($print, 'user_details.last_name AS Last Name');}
        if (session('print_5')) {array_push($print, 'user_log.time_in AS Time In');}
        if (session('print_6')) {array_push($print, 'user_log.time_out AS Time Out');}
        $year = session('year');
        $month = session('month');
        $day = session('day');
        $date = $year."-".$month."-".$day;
        if ($year > 1999 && $month !=  'MM' && $day != 'DD'){$generate = true;}
        if ($generate == true){
            $user = User_detail::select($print)
            ->join('user_log','user_details.user_id','=','user_log.user_id')
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('date_recorded', '=', $date)
            ->orderBy('user_log.time_in', 'ASC')
            ->get(); 

            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(user_log.id) AS count"))
            ->join('user_log','user_details.user_id','=','user_log.user_id')
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('date_recorded', '=', $date)
            ->value('count');

            $user_count = DB::table('user_details')
            ->select(DB::raw("COUNT(DISTINCT user_details.user_id) AS count"))
            ->join('user_log','user_details.user_id','=','user_log.user_id')
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('date_recorded', '=', $date)
            ->value('count');

            $in_gym = DB::table('user_log')
            ->select(DB::raw("COUNT(4) AS count"))
            ->whereRaw("time_out IS NULL AND date = '".$date."'")
            ->value('count');

            return Excel::create('log-'.$date, function($excel) use ($user, $date, $count, $user_count, $in_gym){
            $excel->sheet('log_today', function($sheet) use ($user, $date, $count, $user_count, $in_gym){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Members log of '.$date, 'Entry count: '.$count, 'User count: '.$user_count, 'Have Not Timed Out: '.$in_gym))
                        ->prependRow(3, array())
                        ->setFontFamily("Courier")
                        ->cells('A1:S1', function($cells) {
                            $cells->setFontColor('#8000000');
                            $cells->setFontFamily('Impact');
                            $cells->setFontSize('24');
                        })
                        ->cells('A2:S2', function($cells) {
                            $cells->setFontColor('#8000000');
                        })
                        ->cells('A4:S4', function($cells) {
                            $cells->setFontColor('#FF00000');
                            $cells->setFontWeight('bold');
                        });
                        //->s
            });
        })->download('xls');
        }else{
            $user = User_detail::select($print)
            ->join('user_log','user_details.user_id','=','user_log.user_id')
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->orderBy('user_log.time_in', 'ASC')
            ->get(); 

            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(user_log.id) AS count"))
            ->join('user_log','user_details.user_id','=','user_log.user_id')
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->value('count');

            $user_count = DB::table('user_details')
            ->select(DB::raw("COUNT(DISTINCT user_details.user_id) AS count"))
            ->join('user_log','user_details.user_id','=','user_log.user_id')
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->value('count');

            $in_gym = DB::table('user_log')
            ->select(DB::raw("COUNT(4) AS count"))
            ->whereRaw('time_out IS NULL')
            ->value('count');

            return Excel::create('log-ALL-'.Carbon::parse(Carbon::now())->format('Y-m-d'), function($excel) use ($user, $date, $count, $user_count, $in_gym){
            $excel->sheet('members_sheet', function($sheet) use ($user, $date, $count, $user_count, $in_gym){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Member log as of '.Carbon::parse(Carbon::now())->format('Y-m-d'), 'Entry count: '.$count, 'User count: '.$user_count, 'Have Not Timed Out: '.$in_gym))
                        ->prependRow(3, array())
                        ->setFontFamily("Courier")
                        ->cells('A1:S1', function($cells) {
                            $cells->setFontColor('#8000000');
                            $cells->setFontFamily('Impact');
                            $cells->setFontSize('24');
                        })
                        ->cells('A2:S2', function($cells) {
                            $cells->setFontColor('#8000000');
                        })
                        ->cells('A4:S4', function($cells) {
                            $cells->setFontColor('#FF00000');
                            $cells->setFontWeight('bold');
                        });
                        //->setAutoFilter('A1:R1');
            }); 
        })->download('xls');

        }
    }
}