<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Excel;
use DB;
use Carbon\Carbon;  

class AdminGenReportsController extends Controller
{
	public function index(){
		$userCounts = DB::select("SELECT COUNT(user_id) AS count FROM user INNER JOIN user_details ON user.id = user_details.user_id WHERE user_type = 'member'");
	      $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();
    	return view('admin/generateReports', compact('user', 'notification'));
	}
}
