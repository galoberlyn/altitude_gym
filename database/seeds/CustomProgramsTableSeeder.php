<?php

use Illuminate\Database\Seeder;

class CustomProgramsTableSeeder extends Seeder
{
//    /**
//     * Run the database seeds.
//     *
//     * @return void
//     */
    public function run()
    {
		$faker = Faker\Factory::create();
        $programs = array (
            [
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Incline Bench Press',
				'points' => 30,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Bench Press',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Incline Dumbbell Chest Files',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Incline Dumbbell Bench Press',
				'points' => 24,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Dips',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Close Grip Decline Press',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Overhead Triceps Extensions',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Chest',
                'workout_name' => 'Bench Dips',
				'points' => 45,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'Seated Rows',
				'points' => 30,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'Pull-ups',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'Single Arm Dumbell Rows',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'V-Bar Lat Pulldowns',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'Lat Pulldowns',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'Barbell Curls',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'Laying Cable Curls',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Arms',
                'workout_name' => 'Iso Curls',
				'points' => 45,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Legs',
                'workout_name' => 'Jump Squats',
				'points' => 24,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Legs',
                'workout_name' => 'Deadlifts',
				'points' => 24,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Legs',
                'workout_name' => 'Leg Press',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Legs',
                'workout_name' => 'Step-up',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Legs',
                'workout_name' => 'Goodmornings',
				'points' => 36,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Legs',
                'workout_name' => 'Backward Lungs',
				'points' => 45,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
				'user_id'	=>  $faker->numberBetween(1, 50),
                'workout_type' => 'Legs',
                'workout_name' => 'Calf Raises',
				'points' => 45,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ]
    );
        DB::table('custom_program')->insert($programs);
    }
}
