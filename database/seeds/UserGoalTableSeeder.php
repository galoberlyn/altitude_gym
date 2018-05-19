<?php

use Illuminate\Database\Seeder;

class UserGoalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 300;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('user_goals')->insert([ //,
				'user_id'		=>$i+1,
                'goal_title'	=>$faker->title,
                'goal_description'=>$faker->text,
				'points'=>$faker->numberBetween(1, 300),
                'goal_status'=>$faker->randomElement(['DONE', 'NOT DONE']), 
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now(),
            ]);
        }
    }
}
