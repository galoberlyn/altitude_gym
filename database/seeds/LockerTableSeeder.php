<?php

use Illuminate\Database\Seeder;

class LockerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table('locker')->insert([ //,
				'user_id'		=>	100-$i,
				'locker_number'	=>	$i+1,
				'date_subscription'	=> date("2018-01-17 19:58:25"),
				'date_expiry'	=> date("2018-02-17 19:58:25"),
				'amount'	=>	$faker->numberBetween(100, 1000),
				'status'	=> $faker->randomElement(['available', 'unavailable']),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            DB::table('locker')->insert([ //,
				'user_id'		=>	200-$i,
				'locker_number'	=>	100+$i+1,
				'date_subscription'	=> date("2018-03-17 19:58:25"),
				'date_expiry'	=> date("2018-04-17 19:58:25"),
				'amount'	=>	$faker->numberBetween(100, 1000),
				'status'	=> $faker->randomElement(['available', 'unavailable']),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ]);
        }
		for ($i = 0; $i < 100; $i++) {
            DB::table('locker')->insert([ //,
				'user_id'		=>	300-$i,
				'locker_number'	=>	200+$i+1,
				'date_subscription'	=> date("2018-05-17 19:58:25"),
				'date_expiry'	=> date("2018-06-17 19:58:25"),
				'amount'	=>	$faker->numberBetween(100, 1000),
				'status'	=> $faker->randomElement(['available', 'unavailable']),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ]);
        }
    }
}
