<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
            DB::table('user')->insert([ //,
                'username' 	=>  $faker->username,
                'password'  => bcrypt('123456'),
                'remember_token'  =>  bcrypt($faker->username),
                'user_type' =>	'member',
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ]);
        }
		for ($i = 0; $i < 3; $i++) {
		DB::table('user')->insert([ //,
                'username' 	=>  $faker->username,
                'password' 	=> 	bcrypt('123456'),
                'remember_token'  =>  bcrypt($faker->username),
                'user_type' =>	'manager',
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
            ]);
		}
		DB::table('user')->insert([ //,
                'username' 	=>  $faker->username,
                'password' 	=> 	bcrypt('123456'),
                'remember_token'  =>  bcrypt($faker->username),
                'user_type' =>	'admin',
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now()
        ]);
    }
}
