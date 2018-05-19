<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;  
use Auth;


class AdminProgramController extends Controller
{
   public function program(){
	   date_default_timezone_set('Asia/Manila');
	$active_members = DB::select("SELECT COUNT(status) as status from user_record inner join user on user_id = user.id where status = 'active' and user_type = 'member'");
        $mems = DB::select("SELECT count(id) as status from user WHERE user_type = 'member'"); 
         //date today
        $date_today = Carbon::now()->toFormattedDateString();
        $now = Carbon::now();

        //count the number of days since memberwa
       $daysdiffs = DB::select("SELECT count(user_record.created_at) as 'new' from user_record inner join user on user_record.user_id = user.id WHERE user_type= 'member' and user_record.created_at > DATE_ADD(curdate(), INTERVAL -30 DAY)");
        
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

    $all_programs_distinct = DB::table('programs')
                        ->select('type')
                        ->distinct()
                        ->orderby('type')
                        ->get();

    $all_programs = DB::table('programs')
                    ->select('*')
                    ->orderby('type')
                    ->get();

    $all_workout_days = DB::table('programs')
                ->select('day')
                ->orderby('day')
                ->distinct()
                ->get();

    $date = DB::select('SELECT DATE_FORMAT(curdate(), "%b %d, %Y") as dt');
 
    return view('admin.programs', compact('notification', 'all_programs_distinct', 'all_programs', 'all_workout_days', 'date','active_members', 'mems', 'date_today', 'daysdiffs', 'exp_date'));
   }

   public function dayGetter(Request $request){



     $this->validate($request, [

        "num_days" => 'required',
        "program_name" => 'required'

     ]);

     return redirect('/programs')->with('num_days', $request->input('num_days'))->with('program_name', $request->input('program_name'));



   }

   public function add_program(Request $request){
	   date_default_timezone_set('Asia/Manila');

    // main program name
    $main_name = str_replace(' ', '-',$request->input('program_name'));

    // WORKOUT NA NASA CHECKLIST
  
    $custom_day = $request->input('customize_program_day');
    $custom_type = $request->input('customize_program_type');
    $custom_name = $request->input('customize_program_name');
    $custom_sets = $request->input('customize_program_sets');
    $custom_reps = $request->input('customize_program_reps');

    // WORKOUT NA CUSTOM BY ADMIN

    $workout_muscle = $request->input('workout_muscle');
    $workout_name = $request->input('workout_name');
    $reps_day = $request->input('reps_day');
    $sets_day = $request->input('sets_day');
    $workout_day = $request->input('workout_day');



    for($j=0; $j<count($custom_day); $j++){

    DB::table('programs')
    ->insert([
        "workout_type" => $custom_type[$j],
        "workout_name" => $custom_name[$j],
        "reps" => $custom_reps[$j],
        "sets" => $custom_sets[$j],
        "type" => $main_name,
        "points" => 2,
        "day"=> $custom_day[$j],
        "created_at" => Carbon::now(),
        "updated_at" => Carbon::now()
    ]);

    }
        $wew = $request->input('workout_muscle');



    if($wew[0] != null){
        
       for($k=0; $k<count($workout_muscle); $k++){

        DB::table('programs')
        ->insert([
            "workout_type" => $workout_muscle[$k],
            "workout_name" => $workout_name[$k],
            "reps" => $reps_day[$k],
            "sets" => $sets_day[$k],
            "type" => $main_name,
            "points" => 2,
            "day" => $workout_day[$k],
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()

        ]);

        }

    }
		$allmems = DB::select("SELECT id from user where user_type = 'member'");
		foreach($allmems as $mem){

			 DB::table('notifications')
				->insert([
					"sender" => Auth::id(),
					"receiver" => $mem->id,
					"message" => 'Hello Member! A new program is available. Go check it out now!',
					"notification_type" => 'message',
					"read_at" => null,
					"created_at" => Carbon::now(),
					"updated_at" => Carbon::now()]);
		}
    return redirect('programs')->with('success_add', 'a');


   }

   public function workout_adder(Request $request){
		date_default_timezone_set('Asia/Manila');
		
        $program = $request->input('workout_program');
        $type = $request->input('work_type');
        $name = $request->input('work_name');
        $day = $request->input('work_day');
        $sets = $request->input('work_sets');
        $reps = $request->input('work_reps');
        $points = 0;

        if($program == "Beginner" ){
            $points = 1;
        }elseif($program == "Intermediate"){
            $points = 3;
        }else{
            $points = 2;
        }


        for($i = 0; $i < count($type); $i++){

            DB::table('programs')
            ->insert([
                "workout_type" => $type[$i],
                "workout_name" => $name[$i],
                "day" => $day[$i],
                "sets" => $sets[$i],
                "type" => $program,
                "points" => 2,
                "reps" => $reps[$i],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]);
        }
		
		
        return redirect('/programs')->with('success_add', 'a');

   }

   public function editWork(Request $request)
{
	date_default_timezone_set('Asia/Manila');
	
    $prog_identifier = $request -> input('prog_identifier');
    $days_identifier = $request -> input('days_identifier');

    $custom_prog = DB::table('programs')
    ->distinct()
    ->select('type')
    ->where('type', "!=", "Beginner")
    ->where('type', "!=", "Intermediate")
    ->get(['type']);
    
    $all_prog = DB::table('programs')
    ->select('*')
    ->orderBy('day', 'ASC')
    ->get();
    
    $day_beginner = DB::table('programs')
    ->distinct()
    ->where('type', '=', 'Beginner')
    ->get(['day']);


    $day_intermediate = DB::table('programs')
    ->distinct()
    ->where('type', '=', 'Intermediate')
    ->get(['day']);

    $day_custom = DB::table('programs')
    ->distinct()
    ->where('type', "!=", "Beginner")
    ->where('type', "!=", "Intermediate")
    ->orderBy('day')
    ->get();

    $prog_type = DB::table('programs')
    ->distinct()
    ->where('type', "!=", "Beginner")
    ->where('type', "!=", "Intermediate")
    ->get(['type']);
    
    $notification = DB::table('notifications')
        ->select('*')
        ->leftJoin('user', 'notifications.receiver', '=', 'user.id')
        ->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
        ->where('receiver', '=', Auth::id())
        ->where('read_at', '=', null)
        ->orderBy('notifications.created_at')
        ->get();  

    $edit_prog = DB::table('programs')
            ->select('*')
            ->where('type','=',$prog_identifier)
            ->get();
    

    return view('admin/editprogram', compact('editwork','days_identifier','prog_identifier','notification', 'edit_prog','day_beginner','day_intermediate','day_custom','all_prog','custom_prog','prog_type'));
}
public function editWorkout(Request $request)
{
	date_default_timezone_set('Asia/Manila');
	
    $name_prog = $request -> input('name_prog');
    $day_prog = $request -> input ('day_prog');
    $id_prog = $request -> input('id_prog');

    $edit_type = $request -> input('edit_type');
    $edit_name = $request -> input('edit_name');
    $edit_reps = $request -> input('edit_reps');
    $edit_sets = $request -> input('edit_sets');
    $edit_day = $request -> input('edit_day');

    $custom_prog = DB::table('programs')
    ->distinct()
    ->select('type')
    ->where('type', "!=", "Beginner")
    ->where('type', "!=", "Intermediate")
    ->get(['type']);
    
    $all_prog = DB::table('programs')
    ->select('*')
    ->orderBy('day', 'ASC')
    ->get();
    
    $day_beginner = DB::table('programs')
    ->distinct()
    ->where('type', '=', 'Beginner')
    ->get(['day']);


    $day_intermediate = DB::table('programs')
    ->distinct()
    ->where('type', '=', 'Intermediate')
    ->get(['day']);

    $day_custom = DB::table('programs')
    ->distinct()
    ->where('type', "!=", "Beginner")
    ->where('type', "!=", "Intermediate")
    ->orderBy('day')
    ->get();

    $prog_type = DB::table('programs')
    ->distinct()
    ->where('type', "!=", "Beginner")
    ->where('type', "!=", "Intermediate")
    ->get(['type']);
    
    $notification = DB::table('notifications')
    ->get(); 

    for($i=0; $i<count($edit_type); $i++){
    $edit_workout = DB::table('programs')
            ->select('*')
            ->where('type','=',$name_prog)
            ->where('id','=', $id_prog[$i])
            ->update(['workout_type'=> $edit_type[$i],
                    'workout_name' => $edit_name[$i],
                    'reps' => $edit_reps[$i],
                    'day' => $edit_day[$i]]);
        }
    return redirect('/programs')
    ->with('notification',$notification)
    ->with('edit_type',$edit_type)
    ->with('edit_name',$edit_name)
    ->with('edit_reps',$edit_reps)
    ->with('edit_sets',$edit_sets)
    ->with('edit_day',$edit_day)
    ->with('edit_workout',$edit_workout)
    ->with('day_beginner',$day_beginner)
    ->with('day_intermediate',$day_intermediate)
    ->with('day_custom',$day_custom)
    ->with('all_prog',$all_prog)
    ->with('custom_prog',$custom_prog)
    ->with('prog_type',$prog_type);
}
public function remWork(Request $request)
{
	date_default_timezone_set('Asia/Manila');
	
    $rem_work = $request -> input('rem_work');

    DB::table('programs')
    ->where('id', '=', $rem_work)
    ->delete();

    return redirect('/programs');

}
public function dropProg(Request $request)
{
    $drop_name_prog = $request -> input('drop_name_prog');

    DB::table('programs')
    ->where('type','=',$drop_name_prog)
    ->delete();

    return redirect('/programs')->with('drop_name_prog',$drop_name_prog);
}

}
?>