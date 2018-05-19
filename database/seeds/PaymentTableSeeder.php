<?php

use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
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
            DB::table('payments')->insert([ //,
				'user_id'		=>$faker->numberBetween(1, 300),
				'payment_date'	=>$faker->randomElement([date("2018-03-17 19:58:25"), date("2018-03-18 19:58:25"), date("2018-03-19 19:58:25")]),
				'payment_type'	=>$faker->randomElement(['locker', 'student','regular','muay thai']),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now(),
            ]);
        }
    }
}
