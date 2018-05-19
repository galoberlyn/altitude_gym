<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class MemberTryController extends Controller
{
    //
    public function post(Request $request){

		$strings = array(
		    'Beginner',
		    'Intermediate',
		);


		

    		for($i = 1; $i<= 300; $i++){
    			DB::table('stats')
    			->insert([
    				"user_id" => $i,
    				"height" => 152,
    				"weight" => 75,
    				"exp" => rand(0,25),
    				"total_exp" => rand(0,100),
    				"category" => array_rand($strings),
    				"level" => rand(1,60),
    				"created_at" => Carbon::now(),
    				"updated_at" => Carbon::now()
    			]);
    		}
    }
}
