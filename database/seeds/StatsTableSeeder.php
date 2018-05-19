<?php

use Illuminate\Database\Seeder;

class StatsTableSeeder extends Seeder
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
            DB::table('stats')->insert([ //,
				'user_id'		=>1+$i,
                'height'	=>$faker->numberBetween(2.5, 6.0),
                'weight'	=>$faker->numberBetween(45, 90),
				'exp'	=> $faker->numberBetween(0, 99),
				'category'			=>$faker->randomElement(['beginner', 'advance', 'intermediate']),
				'rank'	=> $faker->numberBetween(1, 100),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now(),
            ]);
        }
    }
}
