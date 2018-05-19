<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon; 

class RFIDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
    public function index()
	{
	$loginBtn = Input::get('rfidlogin');
		
		$query= DB::table('user_details')
		->select('user_log.id','user_details.user_id', 'first_name', 'last_name', 'time_in', 'user_log.date_recorded', 'time_out')		
		->join('user', 'user_details.user_id', '=', 'user.id')
		->join('user_log', 'user_details.user_id', '=', 'user_log.user_id')
		->where('password','=',$loginBtn)
		->whereDate('user_log.date_recorded', '=', Carbon::today()->toDateString())
		->orderBy('user_log.id', 'desc')
		->limit(1)
		->get();
		
		
		$data = DB::table('user_details')
		->select('user_details.user_id', 'first_name', 'last_name')	
	   ->join('user', 'user_details.user_id', '=', 'user.id')
		->where('password','=',$loginBtn)
		->get();
		 
		return view ('rfid/rfidindex')->with('data', $data)->with('query', $query)->with('msg', 'Incorrect ID or Username');
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
	
	public function userDetails(Request $request)
    {	
		date_default_timezone_set('Asia/Manila');
		
		$loginBtn = Input::get('timein');
		$logoutBtn = Input::get('timeout');
		
		$data = DB::table('user_details')
		->select(DB::raw("user_details.user_id, first_name, last_name, avatar, user_record.expiration_date, datediff(expiration_date, curdate()) as diff"))	
	   ->join('user', 'user_details.user_id', '=', 'user.id')
	   ->join('user_record', 'user.id', '=', 'user_record.user_id')
		->where('password','=',$loginBtn)
		->orWhere('id_number', '=', $loginBtn)
		->get();
	
		$query= DB::table('user_details')
		->select(DB::raw("user_log.id,user_details.user_id, first_name, last_name, time_in, user_log.date_recorded, time_out, avatar, user_record.expiration_date, datediff(expiration_date, curdate()) as diff"))	
		->join('user', 'user_details.user_id', '=', 'user.id')
	    ->join('user_record', 'user.id', '=', 'user_record.user_id')
		->join('user_log', 'user_details.user_id', '=', 'user_log.user_id')
		->where('password','=',$logoutBtn)
		->orWhere('id_number', '=', $logoutBtn)
		->whereDate('user_log.date_recorded', '=', Carbon::today()->toDateString())
		->orderBy('user_log.id', 'desc')
		->limit(1)
		->get();
		
		if(empty($loginBtn)) {
		foreach($query as $a){
				$id = $a->id;
				$timein = $a->time_in;
				$timeo = $a->time_out;
				$timeout= date('H:i:s', time());
				$updated = Carbon::now();
				
				$update = DB::table('user_log')
				->where('id','=',$id)
				->update(['time_out' => $timeout,'user_log.updated_at' => $updated]);
				goto e;
			}
		}
		
		if(empty($logoutBtn))
		foreach($data as $b){
				$userid = $b->user_id;
				$timein = date('H:i:s', time());
				$timeout= '';
				$date= date('Y-m-d');
				$created= Carbon::now();
				$updated = Carbon::now();
				
				
				DB::table('user_log')
				->insert(['user_id' => $userid,'time_in' => $timein,'time_out' => $timeout,'date_recorded' => $date,'created_at' => $created,'updated_at' => $updated   ]);
				goto e;
		}
				
				if(count($data) == 0){
					goto r;
				}
		e:
		return view ('rfid/rfidindex')->with('data', $data)->with('query', $query);
		
		r:
		return view ('rfid/rfidindex')->with('data', $data)->with('query', $query)->withErrors('Incorrect ID or Username');
    }

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
    public function show($id)
    {
        //
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
}
