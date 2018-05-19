<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
class MemberGoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //get goals
        $userId = Auth::id();
        // $ongoing_goals = DB::select('SELECT id, goal_title as title, goal_description as description, date_format(created_at, "%M %e, %Y") as date from user_goals where goal_status="undone" AND user_id="'.$userId.'"');

        $ongoing_goals = DB::table('user_goals')
                        ->select('id','goal_title as title','goal_description as description', DB::raw('DATE_FORMAT(created_at, "%M %e, %Y") as date'))
                        ->where('goal_status', '=', 'undone')
                        ->where('user_id', '=', $userId)
                        ->paginate(5);
                        
        
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();

        $done_goals = DB::select('SELECT id, goal_title as title, goal_description as description, date_format(updated_at, "%M %e, %Y") as date from user_goals where goal_status="done" AND user_id="'.$userId.'"');
        
        //expiration date of user till renewal
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');

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

         // expiration locker till renewal
        $exp_date_locker = DB::select('SELECT datediff(date_expiry,"'.Carbon::now().'") as exp_locker from locker where user_id = "'.Auth::id().'"');

        return view('member/mygoals', compact('ongoing_goals', 'done_goals', 'name_result', 'exp_date', 'notify_member', 'notify_system', 'exp_date_locker'));
    }


    /**
    * MARK AS DONE (GOAL) and post Goal
    *
    */
    public function goals(Request $request){

        if($request->has('form_create')){
            $this->validate($request, [
                'goal_title' => 'max:255|required',
                'goal_description' => 'max:255|required',
                
            ]);

          DB::table('user_goals')
         ->insert([
            'user_id' => Auth::id(),
            'goal_title' => $request->input('goal_title'),
            'goal_description' => $request->input('goal_description'),
            'goal_status' => 'undone',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

            return  $this->index();

        }else{
            DB::table('user_goals')->where('id', '=', $request->input('goal_identifier'))
            ->update([
                'goal_status' => 'done'
            ]);

            return $this->index();
        }

    }

    public function goal_marker(Request $request){

        $done = $request->input('done_goal');
        $remove = $request->input('remove_goal');

        if(isset($done)){ 
            
            DB::table('user_goals')->where('id', '=', $done)
            ->update([
                "goal_status" =>  'done' 
            ]);

            return redirect('/mygoals');

        }

         if(isset($remove)){ 
            
            DB::table('user_goals')->where('id', '=', $remove)
            ->delete();
            
            return redirect('/mygoals');

        }
    }

    

}
