<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\User_detail;
use App\User_record;
use App\Payments;
use App\Stats;
use App\Points;
use App\Locker;
use Excel;

class AdminExpiringLockerController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');

    }
    	public function index() {
 
        /*//auto update locker status to available 
        $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `locker` ON user.id = locker.user_id SET `status` = 'available' AND 'locker.user_id' = ' ' WHERE datediff(date_expiry, curdate()) = -1"); */

        //get expiring locker subscription
        $exp_lock = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE date_expiry < curdate() AND user_type = 'member'");

        $exp_lock1 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE date_expiry = curdate() AND user_type = 'member'");

        $exp_lock2 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 1 AND user_type = 'member'");

        $exp_lock3 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 2 AND user_type = 'member' ");

        $exp_lock4 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 3 AND user_type = 'member' ");
        
		$exp_lock5 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 4 AND user_type = 'member' ");
		
		$exp_lock6 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 5 AND user_type = 'member' ");
		
		$exp_lock7 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 6 AND user_type = 'member' ");
        //
        $user = DB::table('user_details')
        ->select('*')
        ->limit('10')
        ->get(); 

        //get notification
          $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();   

        $active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");

        return view ('admin/expiringLocker', compact('user', 'notification','exp_date','member','active_members','unpaid', 'exp_lock', 'exp_lock1', 'exp_lock2', 'exp_lock3', 'exp_lock4', 'mems', 'exp_lock5', 'exp_lock6', 'exp_lock7'));
}

    public function store() {

        /*//auto update locker status to available 
        $unpaid = DB::update("UPDATE `user` INNER JOIN `user_details` ON user.id = user_details.user_id INNER JOIN `locker` ON user.id = locker.user_id SET `status` = 'available' AND 'locker.user_id' = ' ' WHERE datediff(date_expiry, curdate()) = -1"); */

        //get expiring locker subscription
        //get expiring locker subscription
        $exp_lock = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE date_expiry < curdate() AND user_type = 'member'");

        $exp_lock1 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE date_expiry = curdate() AND user_type = 'member'");

        $exp_lock2 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 1 AND user_type = 'member'");

        $exp_lock3 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 2 AND user_type = 'member' ");

        $exp_lock4 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 3 AND user_type = 'member' ");
        
		$exp_lock5 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 4 AND user_type = 'member' ");
		
		$exp_lock6 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 5 AND user_type = 'member' ");
		
		$exp_lock7 = DB::select("SELECT * FROM user INNER JOIN user_details ON user.id = user_details.user_id INNER JOIN locker ON user.id = locker.user_id WHERE datediff(date_expiry, curdate()) = 6 AND user_type = 'member' ");
        //
        $user = DB::table('user_details')
        ->select('*')
        ->limit('10')
        ->get(); 

        //get notification
          $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();   

        $active_members = DB::select("SELECT COUNT(status) as status from user_record where status = 'active'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
        $daysdiffs = DB::select("SELECT count(datediff(curdate(), date_subscription)) as 'differencedays' FROM user INNER JOIN user_record ON user.id = user_record.user_id  where 'differencedays' <= 30 AND user_type = 'member'");
        $exp_date = DB::select("SELECT count(expiration_date) as 'expi' from user_record WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 2 DAY)");

        return view ('admin/expiringLocker', compact('user', 'notification','exp_date','member','active_members','unpaid', 'exp_lock', 'exp_lock1', 'exp_lock2', 'exp_lock3', 'exp_lock4', 'mems', 'exp_lock5', 'exp_lock6', 'exp_lock7'));
    }

    public function prepareLockerExport(Request $request){
        $print_1 = Input::has('1-selected') ? true : false;
        $print_2 = Input::has('2-selected') ? true : false;
        $print_3 = Input::has('3-selected') ? true : false;
        $print_4 = Input::has('4-selected') ? true : false;
        $print_5 = Input::has('5-selected') ? true : false;
        $print_6 = Input::has('6-selected') ? true : false;
        $print_7 = Input::has('7-selected') ? true : false;
        $year = Input::get('year');
        $month = Input::get('month');
        $day = Input::get('day');
        return redirect()->route('locker-export')->with('print_1', $print_1)->with('print_2', $print_2)->with('print_3', $print_3)->with('print_4', $print_4)->with('print_5', $print_5)->with('print_6', $print_6)->with('print_7', $print_7)->with('year', $year)->with('month', $month)->with('day', $day);
    }

    public function lockerExport()
    {
        $print = array();
        $generate = false;
        if (session('print_1')) {array_push($print, "locker.locker_number AS Locker Number");}
        if (session('print_2')) {array_push($print, "locker.date_subscription AS Date of subscription");}
        if (session('print_3')) {array_push($print, "locker.status AS Status");}
        if (session('print_4')) {array_push($print, "user_details.user_id AS Member ID");}
        if (session('print_5')) {array_push($print, "user_details.first_name AS First Name");}
        if (session('print_6')) {array_push($print, "user_details.last_name AS Last Name");}
        if (session('print_7')) {array_push($print, "locker.amount AS Amount");}
        $year = session('year');
        $month = session('month');
        $day = session('day');
        $date = $year."-".$month."-".$day;

        $user = User_detail::select($print)
        ->join('locker','locker.id','=','user_details.user_id')
        ->orderBy('locker.id', 'ASC')
        ->get(); 

        // $count = DB::table('user_details')
        // ->select(DB::raw("COUNT(user.id) AS count"))
        // ->join('user','user.id','=','user_details.user_id')
        // ->where('user_type','=','member')
        // ->orderBy('user_details.user_id', 'DESC')
        // ->value('count');


        return Excel::create('locker-ALL-'.Carbon::parse(Carbon::now())->format('Y-m-d'), function($excel) use ($user, $date){
            $excel->sheet('locker_sheet', function($sheet) use ($user, $date){
                    $sheet  ->fromArray($user)
                            ->prependRow(1, array('Altitude Gym'))
                            ->prependRow(2, array('Current locker subscriptions as of '.Carbon::parse(Carbon::now())->format('Y-m-d')))
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

    public function prepareLockerPaymentExport(Request $request){
        $print_1 = Input::has('1-selected') ? true : false;
        $print_2 = Input::has('2-selected') ? true : false;
        $print_3 = Input::has('3-selected') ? true : false;
        $print_4 = Input::has('4-selected') ? true : false;
        $year = Input::get('year');
        $month = Input::get('month');
        $day = Input::get('day');
        return redirect()->route('locker-payments-export')->with('print_1', $print_1)->with('print_2', $print_2)->with('print_3', $print_3)->with('print_4', $print_4) ->with('year', $year)->with('month', $month)->with('day', $day);
    }

    public function lockerPaymentExport()
    {
        $print = array();
        $generate = false;
        if (session('print_1')) {array_push($print, "payments.payment_date AS Payment date");}
        if (session('print_2')) {array_push($print, "user_details.first_name AS Member's first name");}
        if (session('print_3')) {array_push($print, "user_details.last_name AS Member's last name");}
        if (session('print_4')) {array_push($print, "payments.amount AS Amount");}
        $year = session('year');
        $month = session('month');
        $day = session('day');
        $date = $year."-".$month."-".$day;

       if ($year > 1999 && $month !=  'MM' && $day != 'DD'){$generate = true;}
        if ($generate == true){
            $user = User_detail::select($print)
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_date', '=', $date)
            ->where('payment_type', '=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->get(); 

            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(payments.id) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_date', '=', $date)
            ->where('payment_type', '=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            $total = DB::table('user_details')
            ->select(DB::raw("SUM(amount) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_date', '=', $date)
            ->where('payment_type', '=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            return Excel::create('locker-payments-'.$date, function($excel) use ($user, $date, $count, $total){
            $excel->sheet('locker-payments_today', function($sheet) use ($user, $date, $count, $total){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Lockers payments for '.$date, 'No. of payments: '.$count, 'Total amount: PHP '.$total))
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
            $user = User_detail::select($print)
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_type', '=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->get(); 

            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(payments.id) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_type', '=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            $total = DB::table('user_details')
            ->select(DB::raw("SUM(amount) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_type', '=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            return Excel::create('locker-payments-ALL-'.Carbon::parse(Carbon::now())->format('Y-m-d'), function($excel) use ($user, $count, $total){
            $excel->sheet('locker-payments_sheet', function($sheet) use ($user, $count, $total){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Locker payments for '.Carbon::parse(Carbon::now())->format('Y-m-d'), 'No. of payments:'.$count, 'Total amount: PHP '.$total))
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
        public function prepareMemPaymentExport(Request $request){
        $print_1 = Input::has('1-selected') ? true : false;
        $print_2 = Input::has('2-selected') ? true : false;
        $print_3 = Input::has('3-selected') ? true : false;
        $print_4 = Input::has('4-selected') ? true : false;
        $year = Input::get('year');
        $month = Input::get('month');
        $day = Input::get('day');
        return redirect()->route('mem-payments-export')->with('print_1', $print_1)->with('print_2', $print_2)->with('print_3', $print_3)->with('print_4', $print_4) ->with('year', $year)->with('month', $month)->with('day', $day);
    }

    public function memPaymentExport()
    {
        $print = array();
        $generate = false;
        if (session('print_1')) {array_push($print, "payments.payment_date AS Payment date");}
        if (session('print_2')) {array_push($print, "user_details.first_name AS Member's first name");}
        if (session('print_3')) {array_push($print, "user_details.last_name AS Member's last name");}
        if (session('print_4')) {array_push($print, "payments.amount AS Amount");}
        $year = session('year');
        $month = session('month');
        $day = session('day');
        $date = $year."-".$month."-".$day;

       if ($year > 1999 && $month !=  'MM' && $day != 'DD'){$generate = true;}
        if ($generate == true){
            $user = User_detail::select($print)
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_date', '=', $date)
            ->where('payment_type', '!=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->get(); 

            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(payments.id) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_date', '=', $date)
            ->where('payment_type', '!=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            $total = DB::table('user_details')
            ->select(DB::raw("SUM(amount) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_date', '=', $date)
            ->where('payment_type', '!=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            return Excel::create('membership-payments-'.$date, function($excel) use ($user, $date, $count, $total){
            $excel->sheet('membership-payments_today', function($sheet) use ($user, $date, $count, $total){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Membership subscription payments for '.$date, 'No. of payments: '.$count, 'Total amount: PHP '.$total))
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
            $user = User_detail::select($print)
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_type', '!=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->get(); 

            $count = DB::table('user_details')
            ->select(DB::raw("COUNT(payments.id) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_type', '!=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            $total = DB::table('user_details')
            ->select(DB::raw("SUM(amount) AS count"))
            ->join('payments','payments.user_id','=','user_details.user_id')
            ->where('payment_type', '!=', 'locker')
            ->orderBy('payment_date', 'DESC')
            ->value('count');

            return Excel::create('membership-payments-ALL-'.Carbon::parse(Carbon::now())->format('Y-m-d'), function($excel) use ($user, $count, $total){
            $excel->sheet('membership-payments_sheet', function($sheet) use ($user, $count, $total){
                $sheet  ->fromArray($user)
                        ->prependRow(1, array('Altitude Gym'))
                        ->prependRow(2, array('Membership payments for '.Carbon::parse(Carbon::now())->format('Y-m-d'), 'No. of payments:'.$count, 'Total amount: PHP '.$total))
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
