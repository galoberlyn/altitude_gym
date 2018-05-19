<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Auth;
use App\Quotation;
use Carbon\Carbon;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
   
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

     protected function redirectTo(){

        if(Auth::user()->user_type == 'member'){

           return '/dashboard';

        }elseif(Auth::user()->user_type == 'admin'){

           return '/dashboard_a';

        }elseif(Auth::user()->user_type == 'manager'){

           return '/dashboard_m';
        }

        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:user',
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:1',
            'lname' => 'required|string|max:255',
            'contact_no' => 'required|integer|max:255',
            'nickname' => 'jlpogi',
            'id_number' => '',
            // 'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
    //user type?
        $users= User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'id_number' => '0000000',
            'user_type' => 'admin'
 
        ]);

        
        return $users;
    }
}
