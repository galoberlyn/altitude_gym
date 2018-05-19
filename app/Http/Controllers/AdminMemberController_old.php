<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\User_detail;
use App\User_record;
use App\Payments;
use App\Stats;
use App\Points;
use App\Locker;
use App\User_badge;
use Excel;
use DB;
use Carbon\Carbon;  

class AdminMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    
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
		
        $user_id = Auth::id();

      $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
        //expiration date of user till renewal

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
         
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

        $beginner = DB::select("SELECT avatar, level ,concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where stats.category = 'beginner' AND user_type = 'member' AND status = 'active' ORDER by 2 DESC limit 10");
    
        $intermediate = DB::select("SELECT avatar, level, concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where stats.category = 'intermediate' AND user_type = 'member' AND status = 'active' ORDER by 2 DESC limit 10");
    
        $advance = DB::select("SELECT avatar, level, concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where stats.category = 'advance' AND user_type = 'member' AND status = 'active' ORDER by 2 DESC limit 10");
    
        $recentaward = DB::select("SELECT avatar, user_badge.user_id, concat(first_name,' ',last_name) as 'Name', exp as 'Point', level,count(user_badge.user_id) as 'badge' FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id inner join user_badge on user_details.user_id = user_badge.user_id INNER JOIN user ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id where user_type = 'member' AND status = 'active' group by 1,2,3,4,5 ORDER by badge DESC limit 10");
        
        return view ('admin/home', compact('user', 'notification', 'active_members', 'mems', 'exp_date', 'daysdiffs','beginner','intermediate','advance','recentaward'));

    }


   public function member()
    {
		date_default_timezone_set('Asia/Manila');
		
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
         
         
    $member = DB::table('user_details')
    ->select('user.id','user.avatar','user.username','user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status')
    ->leftJoin('user', 'user_details.user_id', '=', 'user.id')
    ->leftJoin('user_record', 'user_record.id', '=', 'user_details.user_id')
    ->leftJoin('locker','user_details.user_id','=','locker.user_id')
    ->where('user.user_type','=', 'member')
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
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
	
	$memLocker = DB::table('locker')
        ->select('locker_number','locker.status', 'first_name', 'last_name', 'avatar')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'locker.user_id')
        ->leftJoin('user', 'user.id', '=', 'user_details.user_id')
        ->orderBy('locker.id')
        ->get();

    return view('admin/member', compact('member','user','notification','memberLocker','active_members', 'mems', 'exp_date', 'daysdiffs','memLocker','admin_distinct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sort(Request $request)
    {
	date_default_timezone_set('Asia/Manila');
	
    $sortBtn = $request -> input('sort');
    $searchBtn = $request -> input('search');
    $admin_distinct = DB::table('locker')
        ->distinct('locker_set')
        ->select('locker_set')
        ->get();
    $member = DB::table('user_details')
    ->select('user.id','user.avatar','user.username','user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'locker.locker_number','user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status')
    ->leftJoin('user', 'user_details.user_id', '=', 'user.id')
    ->leftJoin('user_record', 'user_record.id', '=', 'user_details.user_id')
    ->leftJoin('locker','user_details.user_id','=','locker.user_id')
	->where('first_name','=',$searchBtn)
    ->orWhere('last_name','=',$searchBtn)
    ->orWhere('locker_number','=',$searchBtn)
    ->orWhere('subscription','=',$searchBtn)
    ->orderBy('user_details.first_name', $sortBtn)
    ->paginate(15);
   $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
    $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
    $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");

    $memLocker = DB::table('locker')
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

    return view('admin/member', compact('member','user','notification','memLocker','exp_date','mems','active_members','admin_distinct'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //deletes locker
    public function postBtn(Request $request)
    {
		date_default_timezone_set('Asia/Manila');
		
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

        $adm = preg_replace("/[^0-9,.]/", "", $admin);

     
    return redirect('/members_list')->with('success', 'Successfully Unassigned Locker!');
    }

    
    public function create()
    {
        $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
		
        return view ('admin/adminAddMember')->with('notification', $notification);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //create nang member
    public function store(Request $request)
    {
		date_default_timezone_set('Asia/Manila');
		
        if ($request-> input('user_type') == 'member'){
           $this->validate($request, [
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
				'nickname' => 'required|max:255',
				'height' => 'nullable|integer|min:100',
                'weight' => 'nullable|integer|min:25',
                'subscription' => 'nullable|string',
				'amount' => 'nullable|integer|min:1',
				
            ]);
        
        if ($request-> input('rfid_number') != ""){
            $this->validate($request, [
                'rfid_number' => 'unique:user'
            ]);
        }
		
            $xs =   DB::table('user')
                    ->orderBy('id', 'desc')
                    ->value('id');
            // $xs = DB::select("SELECT (user_id+1) AS user_id FROM `user_details` ORDER BY 1 DESC LIMIT 1")->value('user_id');

            $user = new User; 
            $user_detail = new User_detail;
            $user_record = new User_record;
            $user_badge = new User_badge;
            $payments = new Payments;
            $stats = new Stats;
            $points = new Points;

            $username = strtolower(str_replace(' ', '', $request -> input('first_name')).str_replace(' ', '', $request -> input('last_name')) .rand(1,999));
            $user->username = $username;
            $user->password = bcrypt('123456');
            $user->user_type = $request-> input('user_type');
            $user->id_number = $request-> input('id_number');
            $user->rfid_number = $request-> input('rfid_number');
            $user->save();

            $xs =   DB::table('user')
                    ->orderBy('id', 'desc')
                    ->value('id');
            $user_detail->user_id = $xs;
            $user_detail->first_name =trim($request->input('first_name'));
            $user_detail->last_name =trim($request->input('last_name'));
            $user_detail->middle_initial =trim($request->input('middle_initial'));
            $user_detail->nickname =trim($request->input('nickname'));
            $user_detail->sex = $request-> input('sex');
            $user_detail->birthdate = $request-> input('birthdate');
            $user_detail->address =trim($request->input('address'));
            $user_detail->contact_no = trim($request->input('contact_no'));
            $user_detail->civil_status = $request-> input('civil_status');
            $user_detail->email_address =trim($request->input('email_address'));
            $user_detail->occupation =trim($request->input('occupation'));
            $user_detail->school_workplace =trim($request->input('school_workplace'));
            $user_detail->used_gym = $request-> input('used_gym');
            $user_detail->medical_condition = trim($request->input('medical_condition'));
            $user_detail->emergency_contact =trim($request->input('emergency_contact'));
            $user_detail->emergency_no =trim($request->input('emergency_no'));
            $user_detail->profile_status = 'Public';

            $user_record->user_id = $xs;
            $user_record->date_subscription = Carbon::createFromFormat('Y-m-d', $request->input('date_subscription')); //Carbon::today();
			$user_record->expiration_date = Carbon::createFromFormat('Y-m-d', $request->input('date_subscription'))->addDays(30); //strtotime('+15 days',$date)
            $user_record->payment_status = 'paid';
            $user_record->status = 'active';


            if ($request->input('custom_subscription') == ''){
                $user_record->subscription =trim($request->input('subscription'));
                if ($request-> input('subscription') == 'regular new'){
                    $user_record->amount = '950';
					$payments->payment_type = 'regular new';
					$payments->amount = '950';
                }elseif ($request-> input('subscription') == 'regular old'){
                    $user_record->amount = '850';
					$payments->payment_type = 'regular old';
					$payments->amount = '850';
                }elseif ($request-> input('subscription') == 'student'){
                    $user_record->amount = '500';
					$payments->payment_type = 'student';
					$payments->amount = '500';
                }elseif ($request-> input('subscription') == 'muay thai'){
                    $user_record->amount = '180';
					$payments->payment_type = 'muay thai';
					$payments->amount = '180';
                }

            }else{
                $user_record->subscription = trim($request->input('custom_subscription'));
                $user_record->amount = trim($request->input('amount'));
                $payments->payment_type = trim($request->input('custom_subscription'));
                $payments->amount = trim($request->input('amount'));
            }
			
            $payments->user_id = $xs;;
            $payments->payment_date = Carbon::today();

            $stats->user_id = $xs;
			if(empty($request-> input('height'))){
				$stats->height = '0';
			}else{
				$stats->height = trim($request-> input('height'));
			}
			if(empty($request-> input('weight'))){
				$stats->weight = '0';
			}else{
				$stats->weight = trim($request-> input('weight'));
			}
            
            $stats->exp = '0';
            $stats->total_exp = '0';
            $stats->category = 'beginner';

            $user_badge->user_id = $xs;
            $user_badge->badge_id = '1';
            $user_badge->date_achieved = Carbon::today();
      
            $user_badge->save();
            $user_detail->save();
            $user_record->save();
            $payments->save();
            $stats->save();

        }else{
           $this->validate($request, [
				'id_number' => 'required|unique:user',
                'first_name' => 'required',
                'last_name' => 'required',
                'middle_initial' => 'required',
                'address' => 'required',
                'contact_no' => 'required|numeric',
                'email_address' => 'required',
                'occupation' => 'required',
                'school_workplace' => 'required',
                'emergency_contact' => 'required',
                'emergency_no' => 'required|numeric',
				'height' => 'nullable|integer|min:100',
                'weight' => 'nullable|integer|min:25'
            ]);
        

            // $xs = DB::select("SELECT (user_id+1) AS user_id FROM `user_details` ORDER BY 1 DESC LIMIT 1")->value('user_id');

            $user = new User; 
            $user_detail = new User_detail;
            $stats = new Stats;
            $user_badge = new User_badge;

            $username = strtolower(str_replace(' ', '', $request -> input('first_name')).str_replace(' ', '', $request -> input('last_name')) .rand(1,999));
            $user->username = $username;
            $user->password = bcrypt('123456');
            $user->user_type = $request-> input('user_type');
            $user->id_number = $request-> input('id_number');
            $user->rfid_number = $request-> input('rfid_number');
            $user->save();

            $xs =   DB::table('user')
                    ->orderBy('id', 'desc')
                    ->value('id');
            $user_detail->user_id = $xs;
            $user_detail->first_name =trim($request->input('first_name'));
            $user_detail->last_name =trim($request->input('last_name'));
            $user_detail->nickname =trim($request->input('nickname'));
            $user_detail->middle_initial =trim($request->input('middle_initial'));
            $user_detail->sex = $request-> input('sex');
            $user_detail->birthdate = $request-> input('birthdate');
            $user_detail->address =trim($request->input('address'));
            $user_detail->contact_no = trim($request->input('contact_no'));
            $user_detail->civil_status = $request-> input('civil_status');
            $user_detail->email_address =trim($request->input('email_address'));
            $user_detail->occupation =trim($request->input('occupation'));
            $user_detail->school_workplace =trim($request->input('school_workplace'));
            $user_detail->used_gym = $request-> input('used_gym');
            $user_detail->medical_condition = trim($request->input('medical_condition'));
            $user_detail->emergency_contact =trim($request->input('emergency_contact'));
            $user_detail->emergency_no =trim($request->input('emergency_no'));
            $user_detail->profile_status = 'Public';

            $stats->user_id = $xs;
           if(empty($request-> input('height'))){
				$stats->height = '0';
			}else{
				$stats->height = trim($request-> input('height'));
			}
			if(empty($request-> input('weight'))){
				$stats->weight = '0';
			}else{
				$stats->weight = trim($request-> input('weight'));
			}
            $stats->exp = '0';
            $stats->total_exp = '0';
            $stats->category = 'beginner';

            $user_badge->user_id = $xs;
            $user_badge->badge_id = '1';
            $user_badge->date_achieved = Carbon::today();

            $stats->save();
            $user_detail->save();       
            $user_badge->save();
        }
        return redirect('members')->with('success', 'User '.$request -> input('first_name').' '.$request -> input('last_name').' created! (username: '.$username.')');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function show($id)
{
	date_default_timezone_set('Asia/Manila');
       $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
		
        $member = User_detail::select('*')
        ->join('user', 'user_details.user_id', '=', 'user.id')
        ->where('user_details.user_id','=', $id)
        ->first();
        $records = User_record::select("user_record.subscription", "user_record.amount", "user_record.date_subscription", "user_record.expiration_date", "user_record.payment_status")
        ->join('user_details', 'user_details.user_id', '=', 'user_record.user_id')
        ->where('user_details.user_id','=', $id)
        ->orderBy('user_record.payment_status','DESC','user_record.date_subscription', 'DESC')
        ->get();

        $lockers = Payments::select("*")
		->join('locker', 'locker.user_id', '=', 'payments.user_id')
        ->where('payments.user_id','=', $id)
		->orderBy('payments.created_at', 'DESC')
        ->get();

        $current_locker = Locker::select('*')
		->join('payments', 'locker.user_id', '=', 'payments.user_id')
        ->where('locker.user_id','=', $id)
		->orderBy('payments.created_at', 'DESC')
		->limit(1)
        ->get();


        return view('admin/adminShowMember')->with('member', $member)->with('notification', $notification)->with('records', $records)->with('lockers', $lockers)->with('current_locker', $current_locker);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = User_detail::join('user', 'user.id', '=', 'user_details.user_id')->where('user_id', '=', $id)->first();
        $member_stats = Stats::where('user_id', '=', $id)->first();
        $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
		
        return view('admin/adminEditMember')->with('member', $member)->with('member_stats', $member_stats)->with('notification', $notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @paSam  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		date_default_timezone_set('Asia/Manila');
		
        $this->validate($request, [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:20',
            'middle_initial' => 'required|max:1',
            'sex' => 'required',
            'address' => 'required',
            'contact_no' => 'required|numeric',
            'civil_status' => 'required',
            'email_address' => 'required',
            'occupation' => 'required|max:35',
            'school_workplace' => 'required|max:35',
            'used_gym' => 'required',
            'emergency_contact' => 'required',
            'emergency_no' => 'required|numeric',
            'email_address' => 'required',
        ]);
        // $xs = DB::select("SELECT (user_id+1) AS user_id FROM `user_details` ORDER BY 1 DESC LIMIT 1")->value('user_id');
        $user_detail = User_detail::where('user_id', '=', $id)->first();
        $user_detail->first_name = trim($request-> input('first_name'));
        $user_detail->last_name = trim($request-> input('last_name'));
        $user_detail->middle_initial = trim($request-> input('middle_initial'));
        $user_detail->sex = trim($request-> input('sex'));
        $user_detail->birthdate = $request-> input('birthdate');
        $user_detail->address = trim($request-> input('address'));
        $user_detail->contact_no =  trim($request-> input('contact_no'));
        $user_detail->civil_status = trim($request-> input('civil_status'));
        $user_detail->email_address = trim($request-> input('email_address'));
        $user_detail->occupation = trim($request-> input('occupation'));
        $user_detail->school_workplace = trim($request-> input('school_workplace'));
        $user_detail->used_gym = $request-> input('used_gym');
        $user_detail->medical_condition =  trim($request-> input('medical_condition'));
        $user_detail->emergency_contact = trim($request-> input('emergency_contact'));
        $user_detail->emergency_no = trim($request-> input('emergency_no'));
        // $payments->user_id = '400';
        // $payments->payment_date = '2018-01-25';
        // $payments->payment_type = $request-> input('payment_type');
        // $user_record->date_subscription = Carbon::createFromFormat('Y-m-d', $request->input('date_subscription'));
        $user_detail->save();
        
        return redirect('members')->with('success', 'User updated!');
        //return 'i got loyalty got royalty inside my dna';
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

    public function prepareMemberExport(Request $request){
        $print_1 = Input::has('1-selected') ? true : false;
        $print_2 = Input::has('2-selected') ? true : false;
        $print_3 = Input::has('3-selected') ? true : false;
        $print_4 = Input::has('4-selected') ? true : false;
        $print_5 = Input::has('5-selected') ? true : false;
        $print_6 = Input::has('6-selected') ? true : false;
        $print_7 = Input::has('7-selected') ? true : false;
        $print_8 = Input::has('8-selected') ? true : false;
        $print_9 = Input::has('9-selected') ? true : false;
        $print_10 = Input::has('10-selected') ? true : false;
        $print_11 = Input::has('11-selected') ? true : false;
        $print_12 = Input::has('12-selected') ? true : false;
        $print_13 = Input::has('13-selected') ? true : false;
        $print_14 = Input::has('14-selected') ? true : false;
        $print_15 = Input::has('15-selected') ? true : false;
        $print_16 = Input::has('16-selected') ? true : false;
        $print_17 = Input::has('17-selected') ? true : false;
        $print_18 = Input::has('18-selected') ? true : false;
        $print_19 = Input::has('19-selected') ? true : false;
        $year = Input::get('year');
        $month = Input::get('month');
        $day = Input::get('day');
        return redirect()->route('user-export')->with('print_1', $print_1)->with('print_2', $print_2)->with('print_3', $print_3)->with('print_4', $print_4)->with('print_5', $print_5)->with('print_6', $print_6)->with('print_7', $print_7)->with('print_8', $print_8)->with('print_9', $print_9)->with('print_10', $print_10)->with('print_11', $print_11)->with('print_12', $print_12)->with('print_13', $print_13)->with('print_14', $print_14)->with('print_15', $print_15)->with('print_16', $print_16)->with('print_17', $print_17)->with('print_18', $print_18)->with('print_19', $print_19)->with('year', $year)->with('month', $month)->with('day', $day);
    }

    public function postForm(Request $request)
    {   
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

        $adm = preg_replace("/[^0-9,.]/", "", $admin);



    return redirect('/members_list')->with('success', 'Successfully Assigned a Locker!');;
    }
    

public function addlock()
        {
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

            return redirect('/members_list')->with('error', 'Maximum per set is 30 lockers!');

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
                        return redirect('/members_list')->with('success', 'Added lockers to set!');
                    }else{

                        for($a=$rem_char+1;$a < $rem_char+$lock_num+1;$a++){

                            $addlock = DB::table('locker')
                            ->insert([
                                ['user_id' => ' ' , 'locker_number' => $last_record->locker_set.$a, 'locker_set' => $last_record->locker_set , 'date_subscription' => '1970-01-01 00:00:00' , 'date_expiry' => '1970-01-01 00:00:00' , 'status' => 'available' , 'created_at' => $current_time , 'updated_at' => $current_time]

                                ]);
                        }
                        return redirect('/members_list')->with('error', 'Last locker set should atleast have 30 lockers! Added lockers to last set.');
                    }

                }else{

                    return redirect('/members_list')->with('error', 'Maximum per set is 30 lockers! Please fill out first the latest set!');

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
                    return redirect('/members_list')->with('success', 'Added Locker Set!');            

                }else{

                    return redirect('/members_list')->with('error', 'Locker set already exists!');


                }


            }

        }
}

    public function memberExport()
    {
        $print = array();
        $generate = false;
        if (session('print_1')) {array_push($print, "user_details.created_at AS Registered On");}
        if (session('print_2')) {array_push($print, "user_details.user_id AS Member's ID");}
        if (session('print_3')) {array_push($print, "user.username AS Username");}
        if (session('print_4')) {array_push($print, "user_details.first_name AS First Name");}
        if (session('print_5')) {array_push($print, "user_details.middle_initial AS Middle Initial");}
        if (session('print_6')) {array_push($print, "user_details.last_name AS Last Name");}
        if (session('print_7')) {array_push($print, "user_details.sex AS Sex");}
        if (session('print_8')) {array_push($print, "user_details.birthdate AS Birthdate");}
        if (session('print_9')) {array_push($print, "user_details.address AS Address");}
        if (session('print_10')){array_push($print, "user_details.contact_no AS Contact Number");}
        if (session('print_11')){array_push($print, "user_details.civil_status AS Civil Status");}
        if (session('print_12')){array_push($print, "user_details.email_address AS Email Address");}
        if (session('print_13')){array_push($print, "user_details.occupation AS Occupation");}
        if (session('print_14')){array_push($print, "user_details.school_workplace AS School or Workplace");}
        if (session('print_15')){array_push($print, "user_details.used_gym AS Used Gym?");}
        if (session('print_16')){array_push($print, "user_details.medical_condition AS Medical Condition");}
        if (session('print_17')){array_push($print, "user_details.emergency_contact AS Emergency Contact");}
        if (session('print_18')){array_push($print, "user_details.emergency_no AS Emergency Contact's Number");}
        if (session('print_19')){array_push($print, "user_details.profile_status AS Profile Status");}
        $year = session('year');
        $month = session('month');
        $day = session('day');
        $date = $year."-".$month."-".$day;

        if ($year > 1999 && $month !=  'MM' && $day != 'DD'){$generate = true;}
        if ($generate == true){
            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(user.id) AS count"))
            ->join('user','user.id','=','user_details.user_id')
            ->whereRaw("user_type = 'member' AND user.created_at LIKE '".$date."%'")
            ->orderBy('user_details.user_id', 'DESC')
            ->value('count');

            $user = User_detail::select($print)
            ->join('user','user.id','=','user_details.user_id')
            ->whereRaw("user_type = 'member' AND user.created_at LIKE '".$date."%'")
            ->orderBy('user_details.user_id', 'DESC')
            ->get(); 
            return Excel::create('members-'.$date, function($excel) use ($user, $date, $count){
            $excel->sheet('members_sheet', function($sheet) use ($user, $date, $count){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Members registered on '.$date, 'Member count: '.$count))
                        ->setFontFamily("Courier")
                        ->cells('A1:S1', function($cells) {
                            $cells->setFontColor('#8000000');
                            $cells->setFontFamily('Impact');
                            $cells->setFontSize('24');
                        })
                        ->cells('A2:S2', function($cells) {
                            $cells->setFontColor('#8000000');
                        })
                        ->cells('A3:S3', function($cells) {
                            $cells->setFontColor('#FF00000');
                            $cells->setFontWeight('bold');
                        });
            }); 
        })->download('xls');
        }else{
            $user = User_detail::select($print)
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->orderBy('user_details.user_id', 'DESC')
            ->get(); 

            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(user.id) AS count"))
            ->join('user','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->orderBy('user_details.user_id', 'DESC')
            ->value('count');


            return Excel::create('members-ALL-'.Carbon::parse(Carbon::now())->format('Y-m-d'), function($excel) use ($user, $date, $count){
            $excel->sheet('members_sheet', function($sheet) use ($user, $date, $count){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Members as of '.Carbon::parse(Carbon::now())->format('Y-m-d'), 'Member count: '.$count))
                        ->setFontFamily("Courier")
                        ->cells('A1:S1', function($cells) {
                            $cells->setFontColor('#8000000');
                            $cells->setFontFamily('Impact');
                            $cells->setFontSize('24');
                        })
                        ->cells('A2:S2', function($cells) {
                            $cells->setFontColor('#8000000');
                        })
                        ->cells('A3:S3', function($cells) {
                            $cells->setFontColor('#FF00000');
                            $cells->setFontWeight('bold');
                        });
                        //->setAutoFilter('A1:R1');
            }); 
        })->download('xls');

        }


    }
    
}
