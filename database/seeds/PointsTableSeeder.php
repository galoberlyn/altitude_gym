<?php

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
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
        for ($i = 0; $i < 300; $i++) {
            DB::table('points')->insert([ //,
				'user_id'       =>$faker->numberBetween(1, 300),
                // 'level'       =>$faker->numberBetween(1, 99),
				//'rank'	=>$faker->randomElement(['beginner', 'advanced ', 'intermediate']),
                'base_point'       =>$faker->numberBetween(10, 20),
                'rank_base'       =>$faker->numberBetween(1, 50),
                'increment_per_level'       =>$faker->numberBetween(1, 20),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now(),
            ]);
        }
    }
}
