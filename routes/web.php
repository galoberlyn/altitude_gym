<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//root
Route::get('/', function () {

	return view('/welcome');
});


Auth::routes();

// ===============================================MEMBER MODULE=======================================================

Route::group(['middleware' => 'App\Http\Middleware\MemberMiddleware'], function(){

	//MemberProfile index
	Route::get('/myprofile', "MemberProfileController@index")->middleware('auth');

	//myworkout section
	Route::get('/myworkout', [ 'as' => 'myworkout', 'uses'=> 'MemberWorkoutController@index' ])->middleware('auth');

	//mygoals section
	Route::get('/mygoals', "MemberGoalsController@index")->middleware('auth');

	//post goals marking as done and posting goals 
	Route::post('/mygoals', "MemberGoalsController@goals")->middleware('auth');

	//gamified policy section
	Route::get('/gamified', 'MemberGamifiedController@index')->middleware('auth');

	//gym policies section
	Route::get('/policies_mem', 'MemberPoliciesController@index')->middleware('auth');


	//member dashboard section
	Route::get('/dashboard', [ 'as' => 'dashboard', 'uses' => 'MemberDashboardController@index' ])->middleware('auth');

	//edit profile secton
	Route::get('/editprofile', [ 'as' => 'editprofile', 'uses' => 'MemberEditProfileController@index'])->middleware('auth');

	//update profile
	Route::post('/editprofile', 'MemberEditProfileController@update_profile')->middleware('auth');

	//view other's profile

	Route::get('/viewprofile/{id}', 'MemberViewProfileController@view_profile')->middleware('auth');

	//leaderboard
	Route::get('/leaderboard', 'MemberLeaderboardController@index')->middleware('auth');
	//filtering leaders
	Route::post('/leaderboard', 'MemberLeaderboardController@filter_leader')->middleware('auth');

	//Viewing all programs
	Route::get('/programs_mem', 'MemberProgramsController@index')->middleware('auth');

	//choosing program
	Route::post('/myworkout','MemberWorkoutController@program_chooser')->middleware('auth');

	//marking program when it's done or not
	Route::post("/workout_checklist", "MemberPointsController@program_marker")->middleware('auth');
	
	//renders points if check point status is clicked
	Route::post("/workout_checklist2", "MemberPointsController@point_render")->middleware('auth');

	//renders points if check point status is clicked (user created program)
	Route::post("/workout_checklist3", "MemberPointsController@point_custom_render")->middleware('auth');

	//get all the notificatins
	Route::get('/member_notifications', "MemberNotifController@index")->middleware('auth');

	//creating custom program
	Route::post('/custom', 'MemberCustomController@customize')->middleware('auth');

	//viewing user's transactions
	Route::get('/member_transactions', 'MemberTransactionsController@index')->middleware("auth");

	//view all the badges
	Route::get('/mybadges', 'MemberAchievementsController@index')->middleware("auth");

	//view all done programs
	Route::get('/done_progs', 'MemberDoneController@index')->middleware("auth");


	Route::get('/try', function(){
		return view('member\try');
	});

	Route::post('/trylang', 'MemberTryController@post')->middleware("auth");

	//goals
	Route::post('goals', 'MemberGoalsController@goal_marker')->middleware('auth');

	Route::post('/changer', 'ChangepasswordController@changer')->middleware('auth');

	Route::post('/clear', 'MemberNotifController@clear')->middleware('auth');

});

// ===============================================END MEMBER MODULE=======================================================


// ***********************************************MANAGER MODULE**********************************************************


Route::group(['middleware' => 'App\Http\Middleware\ManagerMiddleware'], function(){

		// MANAGER's ROUTES
	Route::get('/dashboard_m', function () {
		return view('ManagerModule/managerDash')->middleware('auth');
	})->middleware('auth');

	Route::get('/addMember', function () {
		return view('ManagerModule/addMemberManager');
	})->middleware('auth');

	Route::get('/addBadge', function () {
		return view('ManagerModule/managerAddBadge');
	})->middleware('auth');

	Route::get('/expiringMembership', function () {
		return view('ManagerModule/managerExpMem');
	})->middleware('auth');

	Route::get('/expiringLockerSubscription', function () {
		return view('ManagerModule/expiringLocker');
	})->middleware('auth');

	Route::get('/memberList', function () {
		return view('ManagerModule/memberListManager1');
	});

	Route::get('/memberLog', function () {
		return view('ManagerModule/memberLogManager');
	})->middleware('auth');

	Route::get('/addPayment', function () {
		return view('ManagerModule/addPayment');
	})->middleware('auth');

	Route::get('/confirmation', function () {
		return view('ManagerModule/confirmation');
	})->middleware('auth');

	Route::get('/managerNotification', function () {
		return view('ManagerModule/notification');
	})->middleware('auth');

	Route::get('/assignBadge', function () {
		return view('ManagerModule/assignBadge');
	})->middleware('auth');

	//Manager Dashboard
	Route::resource('/dashboard_m', 'managerDashController');
	Route::get('/dashboard_m', "managerDashController@index")->middleware('auth');

	//Add Member
	Route::resource('addMember/register', 'userController');
	Route::get('/addMember', "userController@index")->middleware('auth');

	//Member List
	Route::resource('memberList', 'memberListController');
	Route::resource('/members_m', 'memberListController');
	Route::post('/memberList', 'memberListController@index')->middleware('auth');
	Route::post('/members_man', "memberListController@postForm")->middleware('auth');
	Route::post('/members_m', "memberListController@postBtn")->middleware('auth');
	Route::get('/members_m', "memberListController@member")->middleware('auth');
	Route::post('/add_lock', "memberListController@addLocker")->middleware('auth');
	Route::get('/searching', "memberListController@searchMember")->middleware('auth');
	Route::get('/sorting_m', "memberListController@sorting_m")->middleware('auth');

	//Member Log
	Route::resource('memberLog', 'memberLogController');
	Route::post('memberLog', 'memberLogController@index')->middleware('auth');
	Route::get('/searcher', "memberLogController@searcher")->middleware('auth');
	Route::get('/sorting', "memberLogController@sorting")->middleware('auth');

	//Expiring Locker Subscription
	Route::resource('expiringLockerSubscription', 'expiringLockerController');
	Route::post('/expiringLockerSubscription', 'expiringLockerController@index')->middleware('auth');

	//Expiring Membership
	Route::resource('expiringMembership', 'expiringMemberController');
	Route::post('/expiringMembership', 'expiringMemberController@index')->middleware('auth');

	//Add Badge
	Route::resource('/addBadge', 'BadgeController');
	Route::post('/badge/disable_m', 'BadgeController@disable_m')->middleware('auth');
	Route::post('/badge/enable_m', 'BadgeController@enable_m')->middleware('auth');

	//Confirm points
	Route::get('/confirmation', 'confirmationController@index')->middleware('auth');
	Route::post('/confirm_man', "confirmationController@store")->middleware('auth');
	Route::post('/declined', "confirmationController@decline")->middleware('auth');
	Route::get('/search_for', "confirmationController@searchConfirm")->middleware('auth');
	Route::get('/sorting_confirm', "confirmationController@sorting_confirm")->middleware('auth');
	Route::post('/accept_conf_name', 'confirmationController@accept_conf_name')->middleware('auth');
	Route::post('/accept_conf_date', 'confirmationController@accept_conf_date')->middleware('auth');


	//Notification
	Route::resource('/managerNotification', 'notificationController');
	Route::get('/search_n', "notificationController@searchConfirm")->middleware('auth');
	Route::get('/sorting_notif', "notificationController@sorting_notif")->middleware('auth');
	Route::post('/read_at', "notificationController@read_at")->middleware('auth');
	Route::post('/read_all', "notificationController@read_all")->middleware('auth');
	Route::post('/read_conf', "notificationController@read_conf")->middleware('auth');

	//Assign Badge
	//Route::resource('assignBadge', 'assignBadgeController');
	Route::get('/assignBadge/{badge_id}', 'assignBadgeController@index')->middleware('auth');
	Route::get('/search_b/{badge_id}', "assignBadgeController@search_b")->middleware('auth');
	Route::get('/sort_badge/{badge_id}', "assignBadgeController@sorting")->middleware('auth');
	Route::post('/assign_badge/{badge_id}', "assignBadgeController@store")->middleware('auth');

	//Gym Policies
	Route::get('/gymPolicies', function () {
		$policies = DB::table('policies')->where('type', 'Safety')->get();
		$policies1 = DB::table('policies')->where('type', 'Courtesy')->get();
		$policies2 = DB::table('policies')->where('type', 'Policies')->get();

		$user = DB::table('user_details')
		->select('*')
		->limit('10')
		->get();

		$current = Auth::id();
		
       //get notification
		$notification = DB::table('notifications')
		->select('*')
		->leftJoin('user', 'notifications.receiver', '=', 'user.id')
		->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
		->where('receiver', '=', $current)
		->where('read_at', '=', null)
		->orderBy('notifications.created_at')
		->get();  


		return view('ManagerModule/gymPoliciesManager', compact('user', 'notification'))->with(['policies' => $policies])->with(['policies1' => $policies1])->with(['policies2' => $policies2]);

	})->middleware('auth');

	//Gamification Policies
	Route::get('/gamificationPolicies', function () {
		$gamepoli = DB::table('policies')->where('category', 'Gamification')->get();
		$points = DB::table('points')->limit('3')->get();

		$user = DB::table('user_details')
		->select('*')
		->limit('10')
		->get(); 

		$current = Auth::id();
		
       //get notification
		$notification = DB::table('notifications')
		->select('*')
		->leftJoin('user', 'notifications.receiver', '=', 'user.id')
		->leftJoin('user_details', 'notifications.sender', '=', 'user_details.user_id')
		->where('receiver', '=', $current)
		->where('read_at', '=', null)
		->orderBy('notifications.created_at')
		->get();   

		
		return view('ManagerModule/managerGamePoli', compact('user', 'notification'))->with(['gamepoli' => $gamepoli])->with(['points' => $points]);
	})->middleware('auth');

	Route::post('/changer_m', 'ChangePasswordController@changer')->middleware('auth');

	// END MANAGER'S ROUTES

});
// ************************************************END MANAGER MODULE************************************************


// ===============================================ADMIN MODULE=======================================================

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
	Route::get('/dashboard_a', "AdminMemberController@index")->middleware('auth');
	Route::get('/home', "AdminMemberController@index")->middleware('auth');
	Route::get('/programs', "AdminProgramController@program")->middleware('auth');
	//NEW ADMIN ROUTES
	Route::get('/search', "AdminSearchFilterController@searchFilter")->middleware('auth');
	Route::get('/members_list', ['as' => 'members', 'uses' =>'AdminMemberController@member'])->middleware('auth');
	Route::get('/edit_work', "AdminProgramController@editWork")->middleware('auth');
	Route::get('/sort', "AdminMemberController@sort")->middleware('auth');
	Route::get('/notification_a', "AdminNotifController@index")->middleware('auth');
	Route::get('/sort_notif', "AdminNotifController@sorting_notif")->middleware('auth');
	Route::get('/search_notif', "AdminNotifController@searchConfirm")->middleware('auth');
	Route::post('/edit_workout', "AdminProgramController@editWorkout");
	Route::post('/delete_program', "AdminProgramController@dropProg");
	Route::post('/rem_work', "AdminProgramController@remWork")->middleware('auth');
	Route::post('/locker', "AdminMemberController@postBtn")->middleware('auth');
	Route::post('/members_a', "AdminMemberController@postForm")->middleware('auth');
	Route::post('/add_locker', "AdminMemberController@addlock")->middleware('auth');
	Route::post('/day', "AdminProgramController@dayGetter")->middleware('auth');
	Route::post('/programs_add', ['as' => 'programs', 'uses' => 'AdminProgramController@add_program'])->middleware('auth');
	//
	Route::get('/search_member', "AdminMemberController@searchFilter")->middleware('auth');
	Route::get('/search_log_today', "AdminUserLogController@searchFilterToday")->middleware('auth');
	Route::get('/search_log_spec/{date_of_search}', "AdminUserLogController@searchFilterSpec")->middleware('auth');
	Route::get('/search_assign_badge/{badge_id}', "AdminAssignBadgeController@searchFilter")->middleware('auth');
	Route::get('/find_payment', "AdminExpirationsController@searchFilter")->middleware('auth');
	Route::get('/log/view_at_date/{id}', "AdminUserLogController@view_at_date");
	Route::get('/find_date', "AdminUserLogController@searchFilter")->middleware('auth');
	Route::get('/payment_ledger', "AdminPaymentLedgerController@index")->middleware('auth');
	Route::resource('/members', 'AdminMemberController');
	Route::resource('/gamification', 'AdminGamePoliciesController');
	Route::resource('/badge', 'AdminAddBadgeController');
	Route::post('/badge/disable', 'AdminAddBadgeController@disable')->middleware('auth');
	Route::post('/badge/enable', 'AdminAddBadgeController@enable')->middleware('auth');
	Route::get('/assign_badge/{badge_id}/award/{user_id}', "AdminAssignBadgeController@assign")->middleware('auth');
	Route::get('/assign_badge/{badge_id}', "AdminAssignBadgeController@index")->middleware('auth');
	Route::resource('/assign_badge', "AdminAssignBadgeController");
	Route::get('/members', 'AdminMemberController@member')->middleware('auth');
	Route::post('/programs', ['as' => 'programs', 'uses' => 'AdminMemberController@add_program'])->middleware('auth');
	Route::resource('/log', "AdminUserLogController");
	Route::get('/log_archive', "AdminUserLogController@memberArchive")->middleware('auth');
	Route::resource('/expiring_locker', "AdminExpiringLockerController");
	Route::resource('/policies', 'AdminGymPoliciesController');
	Route::resource('/expirations', "AdminExpirationsController");
	Route::post('/expirations/payment', "AdminExpirationsController@payment")->middleware('auth');
	Route::get('/reports', "AdminGenReportsController@index")->middleware('auth');
	Route::get('/reports/1', "AdminMemberController@prepareMemberExport")->middleware('auth');
	Route::get('/reports/2', "AdminUserLogController@prepareLogExport")->middleware('auth');
	Route::get('/reports/3', "AdminExpirationsController@prepareExpirationsExport")->middleware('auth');
	Route::get('/reports/4', "AdminMiscReportsController@prepareLeaderboardExport")->middleware('auth');
	Route::get('/reports/5', "AdminExpiringLockerController@prepareLockerExport")->middleware('auth');
	Route::get('/reports/6', "AdminExpiringLockerController@prepareLockerPaymentExport")->middleware('auth');
	Route::get('/reports/7', "AdminExpiringLockerController@prepareMemPaymentExport")->middleware('auth');
	Route::get('/members/{id}/change_pw', "AdminMemberController@changePW")->middleware('auth');
	Route::get('log-export', 'AdminUserLogController@logExport')->name('log-export')->middleware('auth');
	Route::get('user-export', 'AdminMemberController@memberExport')->name('user-export')->middleware('auth');
	Route::get('payments-export', 'AdminExpirationsController@paymentsExport')->name('payments-export')->middleware('auth');
	Route::get('leaderboard-export', 'AdminMiscReportsController@leaderboardExport')->name('leaderboard-export')->middleware('auth');
	Route::get('locker-export', 'AdminExpiringLockerController@lockerExport')->name('locker-export')->middleware('auth');
	Route::get('locker-payments-export', 'AdminExpiringLockerController@lockerPaymentExport')->name('locker-payments-export')->middleware('auth');
	Route::get('mem-payments-export', 'AdminExpiringLockerController@memPaymentExport')->name('mem-payments-export')->middleware('auth');
	Route::post('/changer', 'ChangepasswordController@changer')->middleware('auth');
	Route::post('/add_workout', 'AdminProgramController@workout_adder')->middleware('auth');
	Route::post('/read_atad', "AdminNotifController@read_atad")->middleware('auth');
	Route::post('/read_allad', "AdminNotifController@read_allad")->middleware('auth');


});

// ===============================================END ADMIN MODULE====================================================

	// ===============================================TIMEIN TIMEOUT/ RFID MODULE=======================================================

Route::get('/rfid', "RFIDController@index");
Route::post('/details', "RFIDController@userDetails");
