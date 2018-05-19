<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
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
            DB::table('notifications')->insert([ //,
                'sender' 	=>  $faker->numberBetween(1, 304),
				'receiver'	=>	$faker->numberBetween(1, 304),
                'message' 	=> 	$faker->text,
                'read_at' =>	$faker->randomElement([date("2018-03-17 19:58:25"), date("2018-03-18 19:58:25"), date("2018-03-19 19:58:25")]),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ]);
        }
    }
}
