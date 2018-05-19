<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\User_detail;
use App\User_record;
use App\Payments;
use App\Stats;
use App\Points;
use Excel;
use Dompdf;
use DB;
use Carbon\Carbon;  

class AdminMiscReportsController extends Controller
{
    public function prepareLeaderboardExport(Request $request){
        $leaderboard = Input::get('leaderboard-selection');
        return redirect()->route('leaderboard-export')->with('leaderboard', $leaderboard);
    }

    public function leaderboardExport(){
	    if (session('leaderboard') == 'beginner'){
		    $beginners_array = array();
		    $beginner = DB::select("SELECT level ,concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id where stats.category = 'beginner' ORDER by 3  DESC limit 10");
		    if (count($beginner) < 10){
		    	return "Not enough valid beginners!";
		    }
		    foreach($beginner as $entry){
		    	array_push($beginners_array, $entry->Name);
	    	}

	        $user = User_detail::select('*')
	        ->join('user','user.id','=','user_details.user_id')
	        ->orderBy('user_details.user_id', 'DESC')
	        ->get(); 

	        return Excel::create('leaderboard-beginner', function($excel) use ($user, $beginners_array){
	        	$excel->sheet('leaderboard', function($sheet) use ($user, $beginners_array){
	            $sheet  ->prependRow(5, array('', '', '', '', '', '', '', 'Altitude Gym'))
	                    ->prependRow(6, array('', '', '', '', '', '', '', 'Beginner - TOP 10 '))
	                    ->prependRow(7, array('', '', '', '', '', '', '', Carbon::parse(Carbon::now())->format('Y-m-d')))
	                    ->prependRow(8, array())
	                    ->prependRow(9, array('', '', '', '', '', '', '', $beginners_array[0]))
	                    ->prependRow(10, array('', '', '', '', '', '', '', 'Rank 1'))
	                    ->prependRow(11, array())
	                    ->prependRow(12, array('', '', '', '', '', '', '', $beginners_array[1]))
	                    ->prependRow(13, array('', '', '', '', '', '', '', 'Rank 2'))
	                    ->prependRow(14, array())
	                    ->prependRow(15, array('', '', '', '', '', '', '', $beginners_array[2]))
	                    ->prependRow(16, array('', '', '', '', '', '', '', 'Rank 3'))
	                    ->prependRow(17, array())
	                    ->prependRow(18, array('', '', '', '', '', '', '', $beginners_array[3]))
	                    ->prependRow(19, array('', '', '', '', '', '', '', 'Rank 4'))
	                    ->prependRow(20, array())
	                    ->prependRow(21, array('', '', '', '', '', '', '', $beginners_array[4]))
	                    ->prependRow(22, array('', '', '', '', '', '', '', 'Rank 5'))
	                    ->prependRow(23, array())
	                    ->prependRow(24, array('', '', '', '', '', '', '', $beginners_array[5]))
	                    ->prependRow(25, array('', '', '', '', '', '', '', 'Rank 6'))
	                    ->prependRow(26, array())
	                    ->prependRow(27, array('', '', '', '', '', '', '', $beginners_array[6]))
	                    ->prependRow(28, array('', '', '', '', '', '', '', 'Rank 7'))
	                    ->prependRow(29, array())
	                    ->prependRow(30, array('', '', '', '', '', '', '', $beginners_array[7]))
	                    ->prependRow(31, array('', '', '', '', '', '', '', 'Rank 8'))
	                    ->prependRow(32, array())
	                    ->prependRow(33, array('', '', '', '', '', '', '', $beginners_array[8]))
	                    ->prependRow(34, array('', '', '', '', '', '', '', 'Rank 9'))
	                    ->prependRow(35, array())
	                    ->prependRow(36, array('', '', '', '', '', '', '', $beginners_array[9]))
	                    ->prependRow(37, array('', '', '', '', '', '', '', 'Rank 10'))
	                    ->prependRow(38, array())


	                    ->setFontFamily("Courier")
	                    ->cells('A5:S5', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Impact');
	                        $cells->setFontSize('36');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A6:S6', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Calibri');
	                        $cells->setFontSize('24');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A7:S7', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Calibri');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A9:S9', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('19');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A10:S10', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A12:S12', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('18');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A13:S13', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A15:S15', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('17');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A16:S16', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A18:S18', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A19:S19', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A21:S21', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A22:S22', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A24:S24', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A25:S25', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A27:S27', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A28:S28', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A30:S30', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A31:S31', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A33:S33', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A34:S34', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A36:S36', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A37:S37', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    });
	            }); 
	        })->download('xls');
		}elseif (session('leaderboard') == 'intermediate'){
		    $intermediates_array = array();
		    $intermediate = DB::select("SELECT level ,concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id where stats.category = 'intermediate' ORDER by 3  DESC limit 10");
		    foreach($intermediate as $entry){
		    	array_push($intermediates_array, $entry->Name);
		    }
		    if (count($intermediate) < 10){
		    	return "Not enough valid intermediate members!";
		    }

		    $user = User_detail::select('*')
		    ->join('user','user.id','=','user_details.user_id')
		    ->orderBy('user_details.user_id', 'DESC')
		    ->get(); 
	        return Excel::create('leaderboard-intermediate', function($excel) use ($user, $intermediates_array){
	        $excel->sheet('leaderboard', function($sheet) use ($user, $intermediates_array){
	            $sheet  ->prependRow(5, array('', '', '', '', '', '', 'Altitude Gym'))
                        ->prependRow(6, array('', '', '', '', '', '', 'Intermediate - TOP 10 '))
                        ->prependRow(7, array('', '', '', '', '', '', Carbon::parse(Carbon::now())->format('Y-m-d')))
                        ->prependRow(8, array())
                        ->prependRow(9, array('', '', '', '', '', '', $intermediates_array[0]))
                        ->prependRow(10, array('', '', '', '', '', '', 'Rank 1'))
                        ->prependRow(11, array())
                        ->prependRow(12, array('', '', '', '', '', '', $intermediates_array[1]))
                        ->prependRow(13, array('', '', '', '', '', '', 'Rank 2'))
                        ->prependRow(14, array())
                        ->prependRow(15, array('', '', '', '', '', '', $intermediates_array[2]))
                        ->prependRow(16, array('', '', '', '', '', '', 'Rank 3'))
                        ->prependRow(17, array())
                        ->prependRow(18, array('', '', '', '', '', '', $intermediates_array[3]))
                        ->prependRow(19, array('', '', '', '', '', '', 'Rank 4'))
                        ->prependRow(20, array())
                        ->prependRow(21, array('', '', '', '', '', '', $intermediates_array[4]))
                        ->prependRow(22, array('', '', '', '', '', '', 'Rank 5'))
                        ->prependRow(23, array())
                        ->prependRow(24, array('', '', '', '', '', '', $intermediates_array[5]))
                        ->prependRow(25, array('', '', '', '', '', '', 'Rank 6'))
                        ->prependRow(26, array())
                        ->prependRow(27, array('', '', '', '', '', '', $intermediates_array[6]))
                        ->prependRow(28, array('', '', '', '', '', '', 'Rank 7'))
                        ->prependRow(29, array())
                        ->prependRow(30, array('', '', '', '', '', '', $intermediates_array[7]))
                        ->prependRow(31, array('', '', '', '', '', '', 'Rank 8'))
                        ->prependRow(32, array())
                        ->prependRow(33, array('', '', '', '', '', '', $intermediates_array[8]))
                        ->prependRow(34, array('', '', '', '', '', '', 'Rank 9'))
                        ->prependRow(35, array())
                        ->prependRow(36, array('', '', '', '', '', '', $intermediates_array[9]))
                        ->prependRow(37, array('', '', '', '', '', '', 'Rank 10'))
                        ->prependRow(38, array())


	                    ->setFontFamily("Courier")
	                    ->cells('A5:S5', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Impact');
	                        $cells->setFontSize('36');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A6:S6', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Calibri');
	                        $cells->setFontSize('24');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A7:S7', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Calibri');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A9:S9', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('19');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A10:S10', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A12:S12', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('18');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A13:S13', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A15:S15', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('17');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A16:S16', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A18:S18', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A19:S19', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A21:S21', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A22:S22', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A24:S24', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A25:S25', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A27:S27', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A28:S28', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A30:S30', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A31:S31', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A33:S33', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A34:S34', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A36:S36', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A37:S37', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    });
	            }); 
	        })->download('xls');
	    }elseif (session('leaderboard') == 'advanced'){
	    	$advances_array = array();
		    $advance = DB::select("SELECT level ,concat(first_name,' ',last_name) as 'Name', exp FROM stats INNER JOIN user_details on stats.user_id = user_details.user_id where stats.category = 'advanced' ORDER by 3  DESC limit 10");
		    foreach($advance as $entry){
		    	array_push($advances_array, $entry->Name);
		    }
		    if (count($advance) < 10){
		    	return "Not enough valid advanced members!";
		    }

		    $user = User_detail::select('*')
		    ->join('user','user.id','=','user_details.user_id')
		    ->orderBy('user_details.user_id', 'DESC')
		    ->get(); 
	        return Excel::create('leaderboard-advance', function($excel) use ($user, $advances_array){
	        $excel->sheet('leaderboard', function($sheet) use ($user, $advances_array){
	            $sheet  ->prependRow(5, array('', '', '', '', '', '', 'Altitude Gym'))
                        ->prependRow(6, array('', '', '', '', '', '', 'Advanced - TOP 10 '))
                        ->prependRow(7, array('', '', '', '', '', '', Carbon::parse(Carbon::now())->format('Y-m-d')))
                        ->prependRow(8, array())
                        ->prependRow(9, array('', '', '', '', '', '', $advances_array[0]))
                        ->prependRow(10, array('', '', '', '', '', '', 'Rank 1'))
                        ->prependRow(11, array())
                        ->prependRow(12, array('', '', '', '', '', '', $advances_array[1]))
                        ->prependRow(13, array('', '', '', '', '', '', 'Rank 2'))
                        ->prependRow(14, array())
                        ->prependRow(15, array('', '', '', '', '', '', $advances_array[2]))
                        ->prependRow(16, array('', '', '', '', '', '', 'Rank 3'))
                        ->prependRow(17, array())
                        ->prependRow(18, array('', '', '', '', '', '', $advances_array[3]))
                        ->prependRow(19, array('', '', '', '', '', '', 'Rank 4'))
                        ->prependRow(20, array())
                        ->prependRow(21, array('', '', '', '', '', '', $advances_array[4]))
                        ->prependRow(22, array('', '', '', '', '', '', 'Rank 5'))
                        ->prependRow(23, array())
                        ->prependRow(24, array('', '', '', '', '', '', $advances_array[5]))
                        ->prependRow(25, array('', '', '', '', '', '', 'Rank 6'))
                        ->prependRow(26, array())
                        ->prependRow(27, array('', '', '', '', '', '', $advances_array[6]))
                        ->prependRow(28, array('', '', '', '', '', '', 'Rank 7'))
                        ->prependRow(29, array())
                        ->prependRow(30, array('', '', '', '', '', '', $advances_array[7]))
                        ->prependRow(31, array('', '', '', '', '', '', 'Rank 8'))
                        ->prependRow(32, array())
                        ->prependRow(33, array('', '', '', '', '', '', $advances_array[8]))
                        ->prependRow(34, array('', '', '', '', '', '', 'Rank 9'))
                        ->prependRow(35, array())
                        ->prependRow(36, array('', '', '', '', '', '', $advances_array[9]))
                        ->prependRow(37, array('', '', '', '', '', '', 'Rank 10'))
                        ->prependRow(38, array())


	                    ->setFontFamily("Courier")
	                    ->cells('A5:S5', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Impact');
	                        $cells->setFontSize('36');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A6:S6', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Calibri');
	                        $cells->setFontSize('24');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A7:S7', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Calibri');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A9:S9', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('19');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A10:S10', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A12:S12', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('18');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A13:S13', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A15:S15', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('17');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A16:S16', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A18:S18', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A19:S19', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A21:S21', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A22:S22', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A24:S24', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A25:S25', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A27:S27', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A28:S28', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                     ->cells('A30:S30', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A31:S31', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A33:S33', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A34:S34', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A36:S36', function($cells) {
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('16');
	                        $cells->setAlignment('center');
	                    })
	                    ->cells('A37:S37', function($cells) {
	                        $cells->setFontColor('#8000000');
	                        $cells->setFontFamily('Tahoma');
	                        $cells->setFontSize('12');
	                        $cells->setAlignment('center');
	                    });
	            }); 
	        })->download('xls');
		}
    }
}
