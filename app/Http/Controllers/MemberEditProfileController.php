<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;
use Carbon\Carbon;
use DB;
class MemberEditProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //user's dp
        $userId= Auth::id();
        $dp = DB::table('user')
                ->select('avatar')
                ->where('id', '=', $userId)
                ->get();

        //user's name
        $name_result = DB::table('user_details')
                    ->select('avatar', 'nickname', DB::raw('CONCAT(first_name, " ", middle_initial, " ", last_name) as name'))
                    ->where('user_id', '=', $userId)
                    ->join('user', 'user.id', '=', 'user_details.user_id')
                    ->get();

        //ExpDate
        $exp_date = DB::select('SELECT datediff(expiration_date,"'.Carbon::now().'") as exp_date from user_record WHERE user_id = "'.$userId.'"');

        //user_Details
        $details = DB::table('user_details')
                    ->select('*')
                    ->where('user_id', '=', $userId)
                    ->get();        

        $notify_member = DB::table('notifications')
                        ->select('*')
                        ->join('user_details', 'user_details.user_id', '=', 'notifications.sender')
                        ->orderBy('notifications.id', 'desc')
                        ->where('read_at', '=', NULL)
                        ->where('receiver', '=', Auth::id())
                        ->limit(2)
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

        return view('member/editprofile', compact('dp', 'name_result', 'exp_date', 'details', 'errors', 'notify_member', 'notify_system', 'exp_date_locker'));
    }


    
    public function update_profile(Request $request){
        // return dd(request()->all());

        $this->validate($request, [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'middle_initial' => 'max:255',
            'sex' => 'max:255',
            'birthdate' => 'max:255',
            'address' => 'max:255',
            'contact_no' => 'max:255',
            'civil_status' => 'max:255',
            'email_address' => 'max:255',
            'occupation' => 'max:255',
            'school_workplace' => 'max:255',
            'used_gym' => 'max:255',
            'medical_condition' => 'max:255',
            'emergency_contact' => 'max:255',
            'emergency_no' => 'max:255',
            'address' => 'max:255'
        ]);


      
            DB::table('user_details')->where('user_id', '=', Auth::id())
            ->update([
            'first_name' => $request-> input('first_name'),
            'last_name' => $request-> input('last_name'),
            'middle_initial' => $request-> input('middle_initial'),
            'school_workplace' => $request-> input('school_workplace'),
            'email_address' => $request-> input('email_address'),
            'occupation' => $request-> input('occupation'),
            'contact_no' => $request-> input('contact_no'),
            'emergency_contact' => $request-> input('emergency_contact'),
            'emergency_no' => $request-> input('emergency_no'),
            'profile_status' => $request-> input('profile_status'),
            'address' => $request-> input('address'),
            'updated_at' => Carbon::now(),
            
            ]);

            if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            }
            return redirect()->route('editprofile');
        

    }


   
}
