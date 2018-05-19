<?php

namespace App\Http\Controllers;

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

class AdminPaymentLedgerController extends Controller
{
    public function index()
    {
        $policies = DB::select("SELECT * FROM policies ORDER BY type ASC");
        // $policies_types = DB::select("SELECT DISTINCT type FROM policies");
        $policies_firsts = DB::select("SELECT MIN(id) AS id, type FROM `policies`GROUP BY type ORDER BY type asc");
        
        // ->with('policies_types', $policies_types)
        $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get(); 
        return view ('admin/gymPolicies')->with('policies', $policies)->with('policies_firsts', $policies_firsts)->with('notification', $notification);
    }
}
