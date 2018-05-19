<?php

use Illuminate\Database\Seeder;

class UserBadgeTableSeeder extends Seeder
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
            DB::table('user_badge')->insert([ //,
                'user_id'       =>$faker->numberBetween(1, 200),
                'badge_id'       =>$faker->numberBetween(1, 100),
                'date_achieved' =>    $faker->randomElement([date("2018-03-17 19:58:25"), date("2018-03-18 19:58:25"), date("2018-03-19 19:58:25")]),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now(),
            ]);
        }
    }
}
