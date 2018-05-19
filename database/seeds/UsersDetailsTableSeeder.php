<?php

use Illuminate\Database\Seeder;

class UserDetailsTableSeeder extends Seeder
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
            DB::table('user_details')->insert([ //,
				'user_id'		=>$i+1,
                'first_name'	=>$faker->firstname,
                'last_name'		=>$faker->lastname,
				'middle_initial'=>$faker->randomLetter,
				'sex'			=>$faker->randomElement(['male', 'female']),
				'birthdate'		=>$faker->date($format = 'Y-m-d'),
				'address'		=>$faker->address,
				'contact_no'	=>$faker->numerify('###########'),
				'civil_status'	=>$faker->randomElement(['single', 'married']),
				'email_address'	=>$faker->email,
				'occupation'	=>$faker->jobTitle,
				'school_workplace'=>$faker->company,
				'used_gym'		=>$faker->randomElement(['yes','no']),
				'medical_condition' =>$faker->randomElement(['asthma', 'no']),
				'emergency_contact'=>$faker->name,
				'emergency_no'	=>$faker->numerify('###########'),
				'profile_status' =>$faker->randomElement(['PUBLIC', 'PRIVATE']),
				'created_at' =>	\Carbon\Carbon::now(),
				'updated_at' =>	\Carbon\Carbon::now(),
            ]);
        }
    }
}
