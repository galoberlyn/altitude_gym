<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
class MemberCustomController extends Controller
{
    //
    public function customize(Request $request){

    	$program = $request->input('customize_program');
    	$program_day = $request->input('customize_program_day');
    	$program_type = $request->input('cuztomize_program_type');


    	if($request->input('customize_program') == null){
    		return redirect('/myworkout')->with('wala', 'waa');
    	}



    	
    	for($z = 0; $z<count($program); $z++){
    		
    		$selector_prog = DB::table('programs')
    						->select('*')
    						->where('workout_name', '=', $program[$z])
    						->where('day', '=', $program_day[$z])
    						->get();


    		foreach($selector_prog as $prog){
    			DB::table('user_program')
    				->insert([
    					"user_id" => Auth::id(),
    					"workout_type" => $prog->workout_type,
    					"workout_name" => $prog->workout_name,
    					"reps" => $prog->reps,
    					"sets" => $prog->sets,
    					"day" => $prog->day,
    					"type" => $prog->type,
    					"workout_status" => "on going",
    					"points" => $prog->points,
    					"point_status" => "unrendered",
    					"created_at" => Carbon::now(),
    					"updated_at" => Carbon::now()

    				]);
    		}

    		
    	}


    		

    	
    	

    	

    	return redirect('myworkout');


    }
}
