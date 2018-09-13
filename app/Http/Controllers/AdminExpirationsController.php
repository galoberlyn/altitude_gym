<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\User_detail;
use App\User_record;
use App\Payments;
use App\Stats;
use App\Points;
use DB;
use Excel;
use Carbon\Carbon;  

class AdminExpirationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
         $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
        $date = Carbon::parse(Carbon::now())->format('Y-m-d');
        //count the number of days since memberwa
         $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");

         $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");
         
         //auto update payment_status to unpaid 
        $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `user_record` ON user.id = user_record.user_id SET `payment_status` = 'unpaid' WHERE datediff(expiration_date, curdate()) = -1"); 

        //get expired memberships
        $exp_mem = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE expiration_date < curdate() AND payment_status = 'unpaid' AND user_type = 'member' LIMIT 15"); 

        //get expiring memberships who expires in current date
        $payments = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE expiration_date = curdate() AND user_type = 'member'"); 

        //get expiring membership who expires before 3 days
        $exp = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 3 AND user_type = 'member'"); 

        //get expiring membership who expires before 2 days
        $expired = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 2 AND user_type = 'member'");
		
		$exp_mem5 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 4 AND user_type = 'member'");
		
		$exp_mem6 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 5 AND user_type = 'member'");
		
		$exp_mem7 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 6 AND user_type = 'member'");

        

        //get expiring membership who expires before 1 day
        $expiring = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE datediff(expiration_date, curdate()) = 1 AND user_type = 'member'"); 


         
    // $payments = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN user_log ON user.id = user_log.user_id INNER JOIN user_record ON user.id = user_record.user_id WHERE expiration_date <= curdate() AND status = 'unpaid'"); 
    
    $users = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");
    
    $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");

          $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 

    return view('admin/expiration', compact('user', 'notification','payments','exp','expired','expiring','exp_date','member','active_members','exp_mem','unpaid', 'mems', 'daysdiffs', 'userCounts', 'exp_mem5', 'exp_mem6', 'exp_mem7'));
    }

    public function edit($id)
    {
          $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 
        $payment = User_record::find($id);
        return view('admin/adminAddPayment')->with('payment', $payment)->with('notification', $notification);
    }

    public function update(Request $request, $id)
    {
        $user_record = User_record::find($id);
        $new_payment = new Payments;
        $new_payment->user_id = $user_record->user_id;
        $new_payment->payment_date = Carbon::today();
        $new_payment->payment_type = $user_record->subscription;
        $new_payment->save();
        $user_record->date_subscription = Carbon::today();
        $user_record->expiration_date = Carbon::today()->addDays(30);
        $user_record->payment_status = 'paid';
        $user_record->status = 'active';
        $user_record->updated_at = Carbon::today();
        $user_record->save();
        return redirect('/expirations')->with('success', 'Payment added!');
    }
	
	    public function payment(Request $request)
    {
		date_default_timezone_set('Asia/Manila');

		$userid = $request->input('user_id');
		if($request->input('subscription') == 'regular new'){
		$sub = 'regular old';
		$amt = 850;
		} else{			
		$amt = $request->input('amount');
		$sub = $request->input('subscription');
		}
		$date = Carbon::now();
		$daysss= Carbon::today()->addDays(30);
		
		DB::table('payments')
				->where('user_id','=',$userid)
				->insert(['user_id' => $userid,'payment_date' => $date,'payment_type' => $sub,'amount' => $amt,'created_at' => $date,'updated_at' => $date]);
		
		$wow = DB::table('user_record')->where('user_id', '=', $userid)->first();
		$subs = $wow->subscription;
		
		if ($subs == 'regular new'){
			$subcur = 'regular old';
			$amot = 850;
		}else{
			$subcur = $wow->subscription;
			$amot = $wow->amount;
		}
		$status = 'paid';
		$stat = 'active';
		
		DB::table('user_record')
				->where('user_id','=',$userid)
				->update(['date_subscription' => $date, 'expiration_date'=> $daysss,'subscription' => $subcur ,'amount'=> $amot,'payment_status'=> $status, 'status'=>$stat, 'updated_at'=> $date ]);
				
        return redirect('/expirations')->with('success', 'Payment added!');
    }
	
    public function searchFilter(Request $request)
    {
    $searchBtn = Input::get('search');
    // Perform the query using Query Builder
    $payments = DB::table('user_details')
    ->select('user_record.id', 'user_details.user_id', 'user_details.first_name', 'user_details.last_name', 'user_record.subscription', 'user_record.amount', 'user_record.date_subscription', 'user_record.expiration_date', 'user_record.status')
    ->leftJoin('user_record', 'user_record.user_id', '=', 'user_details.user_id')
    ->orderBy('user_details.user_id')
    ->where('first_name','=',$searchBtn)
    ->orWhere('last_name','=',$searchBtn)
    ->orWhere('expiration_date','=',$searchBtn)
    ->orWhere('amount','=',$searchBtn)
    ->paginate(15);

    $users = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");

    $userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'user'");
    
          $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();  

    return view('admin/expiration', compact('payments', 'users', 'notification', 'userCounts'));
    }

    public function prepareExpirationsExport(Request $request){
        $print_1 = Input::has('1-selected') ? true : false;
        $print_2 = Input::has('2-selected') ? true : false;
        $print_3 = Input::has('3-selected') ? true : false;
        $print_4 = Input::has('4-selected') ? true : false;
        $print_5 = Input::has('5-selected') ? true : false;
        $print_6 = Input::has('6-selected') ? true : false;
        $year = Input::get('year');
        $month = Input::get('month');
        $day = Input::get('day');
        return redirect()->route('payments-export')->with('print_1', $print_1)->with('print_2', $print_2)->with('print_3', $print_3)->with('print_4', $print_4)->with('print_5', $print_5)->with('print_6', $print_6)->with('year', $year)->with('month', $month)->with('day', $day);
    }


    public function paymentsExport()
    {
        $print = array();
        $generate = false;
        if (session('print_1')) {array_push($print, "user_record.expiration_date AS Expiration Date");}
        if (session('print_2')) {array_push($print, "user_record.id AS Transaction ID");}
        if (session('print_3')) {array_push($print, "user.id AS User's ID");}
        if (session('print_4')) {array_push($print, "user_details.first_name AS First Name");}
        if (session('print_5')) {array_push($print, "user_details.last_name AS Last Name");}
        if (session('print_6')) {array_push($print, "user_record.amount AS Amount");}
        $year = session('year');
        $month = session('month');
        $day = session('day');
        $date = $year."-".$month."-".$day;
        if ($year > 1999 && $month !=  'MM' && $day != 'DD'){$generate = true;}
        if ($generate == true){
            $user = User::select($print)
            ->join('user_record','user_record.user_id','=','user.id')
            ->join('user_details','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('expiration_date', '=', $date)
            ->where('payment_status', '=', 'unpaid')
            ->orderBy('user_record.id')
            ->get();

            $count = DB::table('user')
            ->select(DB::raw("COUNT(user_record.id) AS count"))
            ->join('user_record','user_record.user_id','=','user.id')
            ->join('user_details','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('expiration_date', '=', $date)
            ->where('payment_status', '=', 'unpaid')
            ->value('count');

            $total = DB::table('user')
            ->select(DB::raw("SUM(amount) AS count"))
            ->join('user_record','user_record.user_id','=','user.id')
            ->join('user_details','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('expiration_date', '=', $date)
            ->where('payment_status', '=', 'unpaid')
            ->value('count');

            return Excel::create('payments-'.$date, function($excel) use ($user, $date, $count, $total){
            $excel->sheet('payments_today', function($sheet) use ($user, $date, $count, $total){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Memberships that expired on '.$date, 'No. of memberships: '.$count))
                        ->setFontFamily("Courier")
                        ->cells('A1:F1', function($cells) {
                            $cells->setFontColor('#8000000');
                            $cells->setFontFamily('Impact');
                            $cells->setFontSize('24');
                        })
                        ->cells('A2:F2', function($cells) {
                            $cells->setFontColor('#8000000');
                        })
                        ->cells('A3:F3', function($cells) {
                            $cells->setFontColor('#FF00000');
                            $cells->setFontWeight('bold');
                        });
            }); 
        })->download('xls');
        }else{
            $user = User::select($print)
            ->join('user_record','user_record.user_id','=','user.id')
            ->join('user_details','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('payment_status', '=', 'unpaid')
            ->orderBy('user_record.id')
            ->get(); 

            $count = DB::table('user')
            ->select(DB::raw("COUNT(user_record.id) AS count"))
            ->join('user_record','user_record.user_id','=','user.id')
            ->join('user_details','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('payment_status', '=', 'unpaid')
            ->value('count');

            $total = DB::table('user')
            ->select(DB::raw("SUM(amount)"))
            ->join('user_record','user_record.user_id','=','user.id')
            ->join('user_details','user.id','=','user_details.user_id')
            ->where('user_type','=','member')
            ->where('payment_status', '=', 'unpaid')
            ->value('count');

            return Excel::create('payments-ALL-'.Carbon::parse(Carbon::now())->format('Y-m-d'), function($excel) use ($user, $count, $total){
            $excel->sheet('payments_sheet', function($sheet) use ($user, $count, $total){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Memberships that expired as of '.Carbon::parse(Carbon::now())->format('Y-m-d'), 'No. of memberships:'.$count, 'Total uncollected amount: PHP '.$total))
                        ->setFontFamily("Courier")
                        ->cells('A1:F1', function($cells) {
                            $cells->setFontColor('#8000000');
                            $cells->setFontFamily('Impact');
                            $cells->setFontSize('24');
                        })
                        ->cells('A2:F2', function($cells) {
                            $cells->setFontColor('#8000000');
                        })
                        ->cells('A3:F3', function($cells) {
                            $cells->setFontColor('#FF00000');
                            $cells->setFontWeight('bold');
                        });
            }); 
        })->download('xls');

        }
    }
}
