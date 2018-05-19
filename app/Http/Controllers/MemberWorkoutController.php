<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
class MemberWorkoutController extends Controller


{
    //
    public function index(){


    	$userId = Auth::id();
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();

        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');



        // Check if the user already subscribed a workout, determine if done or undone

            $check_program = DB::table("user_program")->where('row_status', '=', 'active')
                            ->where('user_id', '=', Auth::id())
                            ->get();

        //check muna kung pwede na syang i promote sa next category

            $level_checker = DB::table("stats")
                ->select("level" , "category")
                ->where("user_id", "=", $userId)
                ->first();

            if($level_checker->level == 31){

                DB::table('stats')->where("user_id", "=", $userId)
                ->update([ "category" => "intermediate"
                ]);

            }elseif($level_checker->level == 100){

                DB::table('stats')->where("user_id", "=", $userId)
                ->update([ "category" => "advanced"
                ]);
            }
        // choose programs created by altitude gym (Beginner/Intermediate)

            $workout_beginner_days = DB::table('programs')
                                ->distinct()
                                ->where("type", "=", "beginner")
                                ->get(['day']);

            $workout_intermediate_days = DB::table('programs')
                                        ->distinct()
                                        ->where("type", "=", "intermediate")
                                        ->get(['day']);


            $workout_beginner = DB::table('programs')
                    ->select('workout_type', 'workout_name', 'reps', 'sets', 'day', 'type', 'points')
                    ->where('type', '=', 'beginner')
                    ->get();


            $workout_intermediate = DB::table('programs')
                    ->select('workout_type', 'workout_name', 'reps', 'sets', 'day', 'type', 'points')
                    ->where('type', '=', 'intermediate')
                    ->get();

            $workout_custom = DB::table('programs')
                            ->select('type')
                            ->where('type', '!=', 'intermediate')
                            ->where('type', '!=', 'beginner')
                            ->distinct()
                            ->get(['type']);

            $workout_custom_all = DB::table('programs')
                                ->select('workout_type', 'workout_name', 'reps', 'sets', 'day', 'type', 'points')
                                ->where('type', '!=', 'intermediate')
                                ->where('type', '!=', 'beginner')
                                ->orderBy('day')
                                ->get();
        //workout checklist 
                    // queries the on going programs of user
            $workout_checklist = DB::Table('user_program')
                                ->select("*")
                                ->where("user_id", "=", Auth::id())
                                // ->where("workout_status", "=", "on going")
                                ->get();

        //query the progress bar values


         //User's level and rank(beginner)
        $user_lvl = DB::table('stats')
                ->select('*' , 'stats.level as slevel', 'stats.category as scat', 'points.category')
                ->join('points', 'stats.category', '=', 'points.category')
                ->where('stats.user_id', '=', Auth::id())
                ->get();


        // countes the day of the user_program
         $user_workout = DB::table('user_program')
                                ->select('day', 'point_status')
                                ->distinct('day')
                                ->where("user_id", "=", Auth::id())
                                ->where("row_status", "=", 'active')
                                ->orderBy('day')
                                ->get();

        $notify_member = DB::table('notifications')
                        ->select('*')
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->limit(2)
                        ->where('receiver', '=', Auth::id())
                        ->where('read_at', '=', NULL)
                        ->orderBy('notifications.id', 'desc')
                        ->get();

        $notify_system = DB::table('notifications')
                        ->select('*')
                        ->where('receiver', '=', Auth::id())
                        ->where('sender', '=', 'System')
                        ->where('read_at', '=', NULL)
                        ->orderBy('notifications.id', 'desc')
                        ->limit(2)
                        ->get();

        
        //check in blade pag equal, if true show refresh button
        $check_equal = DB::table('user_program')->where('user_id', '=', Auth::id())
        ->where('row_status', '=', 'active')->get();

        $check_equal2 = DB::table('user_program')
                        ->where('user_id', '=', Auth::id())
                        ->where('point_status', '=', 'rendered')
                        ->where('row_status', '=', 'active')
                        ->get();

    //checks the exp to promote to intermediate/advanced
        //check the category of the user
            $user_stat = DB::table('stats')
                ->select('*' , 'stats.level as slevel', 'stats.category as scat', 'points.category')
                ->join('points', 'stats.category', '=', 'points.category')
                ->where('stats.user_id', '=', Auth::id())
                ->first();


        //customize
        $all_workout_day = DB::table('programs')
                        ->distinct()
                        ->select('day')
                        ->get();

        $all_workout = DB::table('programs')
                        ->distinct()
                        ->orderby('day')
                        ->select('*')
                        ->get();

        //check if program is user_created
        $created_program = DB::table('user_program')
                        ->distinct()
                        ->select("type")
                        ->where('user_id', '=', Auth::id())
                        ->where('row_status', '=', 'active')
                        ->get();

         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');
          
        return view('member/myworkout', compact('name_result', 'exp_date', 'workout_beginner', 'workout_intermediate', 'check_program', 'workout_checklist', 'progress', 'user_lvl', 'workout_beginner_days', 'workout_intermediate_days', 'user_workout', 'workout_custom', 'workout_custom_all', 'notify_member', 'notify_system', 'check_equal2', 'check_equal', 'all_workout_day', 'all_workout', 'created_program', 'exp_date_locker'));
    }


    public function program_chooser(Request $request){

    // lagay ka nang ma aachieve nya dito

        $this->validate($request, [
            $request->input('program_chooser') => 'max:255|string'
        ]);
        if($request->input('program_chooser')=="beginner"){


            $datas = DB::table('programs')
                    ->select('workout_type', 'workout_name', 'reps', 'sets', 'day', 'type', 'points')
                    ->where('type', '=', 'beginner')
                    ->get();

            foreach($datas as $data){
                DB::table('user_program')->insert([
                    "user_id" => Auth::id(),
                    "workout_type" => $data->workout_type,
                    "workout_name" => $data->workout_name,
                    "reps" => $data->reps,
                    "sets" => $data->sets,
                    "day" => $data->day,
                    "type" => $data->type,
                    "row_status" => "active",
                    "workout_status" => "on going",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()

                ]);
            }


        }elseif($request->input('program_chooser')=="intermediate"){

            $datas = DB::table('programs')
                    ->select('workout_type', 'workout_name', 'reps', 'sets', 'day', 'type', 'points')
                    ->where('type', '=', 'intermediate')
                    ->get();

            foreach($datas as $data){
                DB::table('user_program')->insert([
                    "user_id" => Auth::id(),
                    "workout_type" => $data->workout_type,
                    "workout_name" => $data->workout_name,
                    "reps" => $data->reps,
                    "sets" => $data->sets,
                    "day" => $data->day,
                    "type" => $data->type,
                    "row_status" => "active",
                    "workout_status" => "on going",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()

                ]);
            }


           
            
        }else{
            //custom workouts Shredding, etc.
            $program_type = $request->input('program_chooser');
            $datas = DB::table('programs')
                    ->select('workout_type', 'workout_name', 'reps', 'sets', 'day', 'type', 'points')
                    ->where('type', '=', $request->input('program_chooser'))
                    ->get();


             foreach($datas as $data){
                DB::table('user_program')->insert([
                    "user_id" => Auth::id(),
                    "workout_type" => $data->workout_type,
                    "workout_name" => $data->workout_name,
                    "reps" => $data->reps,
                    "sets" => $data->sets,
                    "day" => $data->day,
                    "type" => $data->type,
                    "row_status" => "active",
                    "workout_status" => "on going",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()

                ]);
            }


        }

        return redirect()->route('myworkout')->with('success', 'Profile updated!');
        
    }



    



    
        
            


    
}
