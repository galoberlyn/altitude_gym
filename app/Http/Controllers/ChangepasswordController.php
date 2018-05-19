<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Hash;
class ChangepasswordController extends Controller
{
    //
    public function changer(Request $request){

    	$old = $request->input('oldpw');
    	$new = $request->input('newpw');
    	$conf = $request->input('confnewpw');

    	$myold = DB::table('user')
      ->select('password', 'user_type')
      ->where('id', '=', Auth::id())
      ->first();

      if(Hash::check($old, $myold->password) && ($new == $conf)){
         
         $cryptnew = bcrypt($new);

         DB::table('user')
         ->where('id', '=', Auth::id())
         ->update([
            "password" => $cryptnew,
            "updated_at" => Carbon::now()
            ]);

         Auth::logout();
         return redirect('/login');

     }else{
         

         if($myold->user_type == 'manager'){

            return redirect('/dashboard_m')->with('error_password', 'Password mismatch');

        }elseif($myold->user_type == 'admin'){

            return redirect('dashboard_a')->with('error_password', 'Password mismatch');

        }elseif($myold->user_type == 'member'){

            return redirect('dashboard')->with('error_password', 'Password mismatch');

        }
        
    }


}
}
