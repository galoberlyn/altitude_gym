<?php

use Illuminate\Database\Seeder;

class UserLogTableSeeder extends Seeder
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
            DB::table('user_log')->insert([ //,
				'user_id'    =>$faker->numberBetween(1, 300),
                'time_in'    =>$faker->randomElement([date("8:00:00"),date("9:00:00"),date("10:00:00"), date("11:00:00"), date("12:00:00")]),
                'time_out'	 =>$faker->randomElement([date("13:00:00"),date("14:00:00"),date("15:00:00"), date("16:00:00"), date("17:00:00"), NULL]),
				'date'	     => $faker->randomElement([date("2018-03-17"),date("2018-03-18"),date("2018-03-19")]),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now(),
            ]);
        }
    }
}
