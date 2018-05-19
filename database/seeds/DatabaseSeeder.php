<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// $this->call(BadgesTableSeeder::class);
		// // $this->call(CustomProgramsTableSeeder::class);
		// // //$this->call(GamificationPolicyTableSeeder::class);
		//$this->call(UsersTableSeeder::class);
		// $this->call(UserDetailsTableSeeder::class);
		// $this->call(UserProgramTableSeeder::class);
		// $this->call(UserRecordTableSeeder::class);
		$this->call(UserLogTableSeeder::class);
		// $this->call(PaymentTableSeeder::class); 
		// // // //$this->call(ProgramsTableSeeder::class);
		// $this->call(StatsTableSeeder::class);
		// $this->call(LockerTableSeeder::class);
		// $this->call(NotificationsTableSeeder::class);
		// $this->call(UserLogTableSeeder::class);
		// // // //$this->call(PoliciesTableSeeder::class);
		// $this->call(PointsTableSeeder::class);
		// $this->call(UserBadgeTableSeeder::class);
		// // $this->call(UserBadgeTableSeeder::class);
		// $this->call(UserGoalTableSeeder::class);
    }
}
