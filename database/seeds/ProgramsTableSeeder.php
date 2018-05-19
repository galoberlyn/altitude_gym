<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
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
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Incline Bench Press',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 10,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Bench Press',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Incline Dumbbell Chest Files',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 8,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Incline Dumbbell Bench Press',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 8,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Dips',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Close Grip Decline Press',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Overhead Triceps Extensions',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Bench Dips',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 15,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Seated Rows',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 10,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Pull-ups',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Single Arm Dumbell Rows',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'V-Bar Lat Pulldowns',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Lat Pulldowns',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Barbell Curls',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Laying Cable Curls',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Arms',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Iso Curls',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 15,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Legs',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Jump Squats',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 8,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Legs',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Deadlifts',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 8,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Legs',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Leg Press',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Legs',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Step-up',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Legs',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Goodmornings',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 12,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Legs',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Backward Lungs',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 15,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
			[
                'workout_type' => 'Legs',
                'points' => $faker->randomElement([25 , 36]), 'workout_name' => 'Calf Raises',
				'sets' => 3,
                'day' => $faker->numberBetween(1,5), 'reps' => 15,
				'type' => $faker->randomElement(['muay thai', 'regular']), 'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ]
    );
        DB::table('programs')->insert($programs);
    }
}
