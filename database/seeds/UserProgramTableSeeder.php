<?php

use Illuminate\Database\Seeder;

class UserProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 300; $i++) {
            DB::table('user_program')->insert([ //,
				'user_id'		=>300-$i,
                'workout_type' => 'Chest',
                'points' => $faker->randomElement([25 , 36]),
                'workout_name' => $faker->text,
                'workout_status' => $faker->randomElement(['done', 'ongoing']),
                'sets' => 3,
                'day' => $faker->numberBetween(1,5),
                'reps' => 10,
                'type' => $faker->randomElement(['muay thai', 'regular']),
                'row_status'    => "NOT OK",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
