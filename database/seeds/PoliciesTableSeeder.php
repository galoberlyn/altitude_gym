<?php

use Illuminate\Database\Seeder;

class PoliciesTableSeeder extends Seeder
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
        for ($i = 0; $i < 20; $i++) {
            DB::table('policies')->insert([ //,
                'category'  =>$faker->randomElement(['Gym', 'Gamification']),
                'type'  =>$faker->randomElement(['safety', 'courtesy']),
                'policy_description'  =>$faker->text,
                'points' => $faker->randomElement([25 , 36]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
