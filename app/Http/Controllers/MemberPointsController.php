<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
class MemberPointsController extends Controller
{
    //
    public function program_marker(Request $request){

        // marks the program when it's done or not /        
        $data2 = $request->input("day_identifier");

       
            DB::table("user_program")
            ->where('user_id', '=', Auth::id())
            ->where('day', '=', $data2)
            ->update([
                "workout_status" => "done",
                "point_status" => "for_rendering"
            ]);

        //get the id of all the manager then notify him/her for workout confirmation
                $managers = DB::table('user')
                            ->select('id')
                            ->where('user_type', '=', 'manager')
                            ->get();

                foreach($managers as $manager){
                    DB::table('notifications')
                    ->insert([
                        'sender' => Auth::id(),
                        'receiver' => $manager->id,
                        'message' => "Please validate Member's workout",
                        'read_at' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'notification_type' => "confirmation"
                    ]);
                }

        $user_work = DB::table('user_program')
                    ->select('*')
                    ->where('user_id', '=', Auth::id())
                    ->limit(1)
                    ->get();
         foreach($user_work as $user_program_type){
           
         DB::table('userworkout_validation')->where('user_id', '=', Auth::id())
                    ->insert([
                        "user_id" => Auth::id(),
                        "type" => $user_program_type->type,
                        "day_identifier" => $data2,
                        "status" => "for_validation",
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now()
                    ]);    

         }           

 		

            return redirect()->route('myworkout');

    }



     /*
     *
     * renderes points when manager validates the workout
     * 
     */

    public function point_render(){

        $check = DB::table('user_program')
                            ->select('point_status')
                            ->where('point_status', '=', 'rendered')
                            ->where('row_status', '=', 'active')
                            ->where('user_id', '=', Auth::id())
                            ->get();

        $check2 = DB::table('user_program')
                    ->where('user_id', '=', Auth::id())
                    ->where('row_status', '=', 'active')
                    ->get();


        if(count($check) == count($check2)){
            

            //check the program typeo f user
            $program = DB::table('user_program')
                            ->select('type')
                            ->limit(1)
                            ->where('user_id', '=', Auth::id())
                            ->first();

            if($program->type=='Beginner'){ //if user's program is beginner, + points == 1+9++++++

                $multiplier = 1;
                $this->program_points($multiplier);  
             

            }elseif($program->type=='Intermediate'){ //if user's program is intermediate, + points == 3

                $multiplier = 3;
                $this->program_points($multiplier);

            }else{ //if user's program is custom, + points == 2

                $multiplier = 2; 
                $this->program_points($multiplier);

            }

            

            

            return redirect('myworkout')->with('finished', 'nice');

        }else{

            return redirect('myworkout')->with('not_rendered', 'Sorry wala pa');

        }
        


    }

    public function program_points($multiply){

        //check the category of the user
            $user_stat = DB::table('stats')
                ->select('*' , 'stats.level as slevel', 'stats.category as scat', 'points.category')
                ->join('points', 'stats.category', '=', 'points.category')
                ->where('stats.user_id', '=', Auth::id())
                ->first();

            $rendered_points = DB::table('user_program')
                            ->select('point_status')
                            ->where('point_status', '=', 'rendered')
                            ->where('row_status', '=', 'active')
                            ->where('workout_status', '=', 'done')
                            ->where('user_id', '=', Auth::id())
                            ->get();

            $earned_points = count($rendered_points);

            $level_increment = 0;
            $extra_exp=0;

            $sum_exp = ($user_stat -> exp) + $earned_points;
        //switch statement is the category type of the user
                switch($user_stat->scat){
                    case 'Beginner':
                        $base_point = 40;
                        if($sum_exp >= $base_point){ 

                            $level_increment = ($user_stat->slevel) + ($sum_exp/$base_point);
                            $extra_exp = $sum_exp % $base_point;

                            DB::table('stats')->where('user_id', '=', Auth::id())
                            ->update([
                                "level" => $level_increment,
                                "exp" => $extra_exp,
                                "total_exp" => ($user_stat->total_exp) + $multiply * $earned_points,
                                "updated_at" => Carbon::now()
                            ]);

                            DB::table('user_program')
                            ->where('user_id', '=', Auth::id())
                            ->where('row_status', '=', 'active')
                            ->update([
                                "row_status" => "archived",
                                "updated_at" => Carbon::now()
                            ]);
                        }else{

                            DB::table('stats')->where("user_id", '=', Auth::id())
                            ->update([
                                "exp" => $user_stat->exp + $earned_points,
                                "total_exp" => $user_stat->exp + $earned_points,
                                "updated_at" => Carbon::now()
                            ]);

                            DB::table('user_program')
                            ->where('user_id', '=', Auth::id())
                            ->where('row_status', '=', 'active')
                            ->update([
                                "row_status" => "archived",
                                "updated_at" => Carbon::now()
                            ]);
                        }

                            
                    break;

                    case 'Intermediate':

                    $base_point = 60;
                     if($sum_exp >= 60){

                            $level_increment = ($user_stat->slevel) + ($sum_exp/$base_point);
                            $extra_exp = $sum_exp % $base_point;

                            DB::table('stats')->where('user_id', '=', Auth::id())
                            ->update([
                                "level" => $level_increment,
                                "exp" => $extra_exp,
                                "total_exp" => ($user_stat->total_exp) + ($multiply * $earned_points),
                                "updated_at" => Carbon::now()
                            ]);

                            DB::table('user_program')
                            ->where('user_id', '=', Auth::id())
                            ->where('row_status', '=', 'active')
                            ->update([
                                "row_status" => "archived",
                                "updated_at" => Carbon::now()
                            ]);
                        }else{

                            DB::table('stats')->where("user_id", '=', Auth::id())
                            ->update([
                                "exp" => $user_stat->exp + $earned_points,
                                "total_exp" => $user_stat->exp + $earned_points,
                                "updated_at" => Carbon::now()
                            ]);

                            DB::table('user_program')
                            ->where('user_id', '=', Auth::id())
                            ->where('row_status', '=', 'active')
                            ->update([
                                "row_status" => "archived",
                                "updated_at" => Carbon::now()
                            ]);
                        }

                    break;

                    case 'Advanced':
                     $base_point = 80;
                     if($sum_exp >= 80){

                            $level_increment = ($user_stat->slevel) + ($sum_exp/$base_point);
                            $extra_exp = $sum_exp % $base_point;

                            DB::table('stats')->where('user_id', '=', Auth::id())
                            ->update([
                                "level" => $level_increment,
                                "exp" => $extra_exp,
                                "total_exp" => ($user_stat->total_exp) + ($multiply * $earned_points),
                                "updated_at" => Carbon::now()
                            ]);

                            DB::table('user_program')
                            ->where('user_id', '=', Auth::id())
                            ->where('row_status', '=', 'active')
                            ->update([
                                "row_status" => "archived",
                                "updated_at" => Carbon::now()
                            ]);

                        }else{

                            DB::table('stats')->where("user_id", '=', Auth::id())
                            ->update([
                                "exp" => $user_stat->exp + $earned_points,
                                "total_exp" => $user_stat->exp + $earned_points,
                                "updated_at" => Carbon::now()
                            ]);

                            DB::table('user_program')
                            ->where('user_id', '=', Auth::id())
                            ->where('row_status', '=', 'active')
                            ->update([
                                "row_status" => "archived",
                                "updated_at" => Carbon::now()
                            ]);
                        }

                    
                    break;
                        
                }

    }


    public function point_custom_render(){

        $check = DB::table('user_program')
                            ->select('point_status')
                            ->where('point_status', '=', 'rendered')
                            ->where('user_id', '=', Auth::id())
                            ->where('row_status', '=', 'active')
                            ->get();

        $check2 = DB::table('user_program')
                    ->where('user_id', '=', Auth::id())
                    ->where('row_status', '=', 'active')
                    ->get();

                    //check if point is rendered
        if(count($check) == count($check2)){

           
            $points = DB::table('user_program')
                    ->select('points')
                    ->where('user_id', '=', Auth::id())
                    ->get();

            $total = 0;

            foreach($points as $point){
                
                $total=$total+$point->points;

            }
            
            //check level to see the base point
            $user_stat = DB::table('stats')
                ->select('*' , 'stats.level as slevel', 'stats.category as scat', 'points.category')
                ->join('points', 'stats.category', '=', 'points.category')
                ->where('stats.user_id', '=', Auth::id())
                ->first();

            $earned_points = $total;

            $level_increment = 0;
            $extra_exp=0;

            $sum_exp = ($user_stat -> exp) + $earned_points;
        //switch statement is the category type of the user
                switch($user_stat->scat){
                    case 'Beginner':
                        $base_point = 40;
                        if($sum_exp >= $base_point){ 

                            $level_increment = ($user_stat->slevel) + ($sum_exp/$base_point);
                            $extra_exp = $sum_exp % $base_point;

                            DB::table('stats')->where('user_id', '=', Auth::id())
                            ->update([
                                "level" => $level_increment,
                                "exp" => $extra_exp,
                                "total_exp" => ($user_stat->total_exp) + $multiply * $earned_points,
                                "updated_at" => Carbon::now()
                            ]);
                        }else{

                            DB::table('stats')->where("user_id", '=', Auth::id())
                            ->update([
                                "exp" => $user_stat->exp + $earned_points,
                                "total_exp" => $user_stat->exp + $earned_points,
                                "updated_at" => Carbon::now()
                            ]);
                        }

                        break;

                    case 'Intermediate':

                    $base_point = 60;
                     if($sum_exp >= 60){

                            $level_increment = ($user_stat->slevel) + ($sum_exp/$base_point);
                            $extra_exp = $sum_exp % $base_point;

                            DB::table('stats')->where('user_id', '=', Auth::id())
                            ->update([
                                "level" => $level_increment,
                                "exp" => $extra_exp,
                                "total_exp" => ($user_stat->total_exp) + ($multiply * $earned_points),
                                "updated_at" => Carbon::now()
                            ]);
                        }else{

                            DB::table('stats')->where("user_id", '=', Auth::id())
                            ->update([
                                "exp" => $user_stat->exp + $earned_points,
                                "total_exp" => $user_stat->exp + $earned_points,
                                "updated_at" => Carbon::now()
                            ]);
                        }

                    break;

                    case 'Advanced':

                    $base_point = 80;
                     if($sum_exp >= 80){

                            $level_increment = ($user_stat->slevel) + ($sum_exp/$base_point);
                            $extra_exp = $sum_exp % $base_point;

                            DB::table('stats')->where('user_id', '=', Auth::id())
                            ->update([
                                "level" => $level_increment,
                                "exp" => $extra_exp,
                                "total_exp" => ($user_stat->total_exp) + ($multiply * $earned_points),
                                "updated_at" => Carbon::now()
                            ]);
                        }else{

                            DB::table('stats')->where("user_id", '=', Auth::id())
                            ->update([
                                "exp" => $user_stat->exp + $earned_points,
                                "total_exp" => $user_stat->exp + $earned_points,
                                "updated_at" => Carbon::now()
                            ]);
                        }
                    break;


                    }
                    
            DB::table('user_program')->where('user_id', '=', Auth::id())->update([
                "row_status" => "archived
                "]);

            DB::table('notifications')
            ->insert([
                "sender" => "System",
                "receiver" => Auth::id(),
                "message" => "Your points have been validated by the manager",
                "notification_type" => "System",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]);

            return redirect('myworkout')->with('finished', 'nice');

        }else{

            return redirect('myworkout')->with('not_rendered', 'Sorry wala pa');

        }
        
    }



        

}
