<?php

use Illuminate\Database\Seeder;

class GamificationPolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
		$badges = array (
            [
                'policy_name' 	=>  'Finish Program',
				'policy_description'	=>	'When a member finishes a program they gain points, trainers checks his progress or if he really finish the program he gave',
                'points' 	=> 	25,
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ],
			[
                'policy_name' 	=>  'Check Weights',
				'policy_description'	=>	'When member uses a heavy weights in exercises(chest,back,biceps,legs,shoulder) they are given points and badges, trainers checks the if its true',
                'points' 	=> 	25,
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ],
			[
                'policy_name' 	=>  'Bring Own Towel/Water',
				'policy_description'	=>	'Members that are bring their own towel and water gets points and badges , Trainer checks if they have their towels and waters',
                'points' 	=> 	25,
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ],
			[
                'policy_name' 	=>  'Avail Locker',
				'policy_description'	=>	'Member who avails lockers for their equipments are given points',
                'points' 	=> 	25,
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ],
		);
		DB::table('gamification_policy')->insert($badges);
    }
}
