<?php

use Illuminate\Database\Seeder;

class UserRecordTableSeeder extends Seeder
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
            DB::table('user_record')->insert([ //,
				'user_id'		=>$i+1,
                'subscription'	=>$faker->randomElement(['950', '500','850','muay thai']),
                'amount'	=>$faker->randomElement(['850', '950','500','180']),
				'date_subscription'	=> date("2018-02-28 19:58:25"),
				'expiration_date'	=> date("2017-10-18 19:58:25"),
				'status'			=>$faker->randomElement(['active','inactive']), 'payment_status' => $faker->randomElement(['paid', 'unpaid']),
				'created_at' =>	date("2018-01-28 19:58:25"),
				'updated_at' =>	\Carbon\Carbon::now()
            ]);
        }
    }
}
