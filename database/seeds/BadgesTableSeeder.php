<?php

use Illuminate\Database\Seeder;

class BadgesTableSeeder extends Seeder
{
//    /**
//     * Run the database seeds.
//     *
//     * @return void
//     */
    public function run()
    {
        $badges = array (
            [
                'badge_name' => 'GREEN HORN',
                'badge_description' => 'Rewarded for registration',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
            ],
            [
				'badge_name' => 'GYM ADEPT',
                'badge_description' => 'Rewarded for one month members',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'GYM INTERMEDIATE',
                'badge_description' => 'Rewarded for 6 months members',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'GYM VETERAN',
                'badge_description' => 'Rewarded for one year members',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'FIRST STEPS',
                'badge_description' => 'Rewarded for 1k treadmill',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'POINT RUNNER',
                'badge_description' => 'Rewarded for 2k on treadmill',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'MARATHONIST',
                'badge_description' => 'Rewarded for 5k, 7k etc.',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'SLIMMING DOWN',
                'badge_description' => 'Rewarded for losing 2% of body weight',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'BEEFING UP',
                'badge_description' => 'Rewarded for gaining 2% of body weight',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'PROGRAM FINISHER',
                'badge_description' => 'Rewarded for finishing a 2 program that is given by the trainer',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'CHEST BUILDER',
                'badge_description' => 'Rewarded for using weights of 20kg in chest exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'CHIEF CHEST',
                'badge_description' => 'Rewarded for using weights of 50kg in chest exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'PRO PRESS',
                'badge_description' => 'Rewarded for using weigths of 100kg in chest exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'BABY BICEPS',
                'badge_description' => 'Rewarded for using weights of 20kg in bicep exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'BICEPTIONIST',
                'badge_description' => 'Rewarded for using weights of 50kg in bicep exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'THE GUNS',
                'badge_description' => 'Rewarded for using weights of 100kg in bicep exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'THE BAKI',
                'badge_description' => 'Rewarded for using weights of 20 kg in back exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'THE SUPERMAN',
                'badge_description' => 'Rewarded for using weights of 50 kg in back exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'COBRA',
                'badge_description' => 'Rewarded for using weights of 100 kg in back exercise',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'SCORER',
                'badge_description' => 'Rewarded for members who are in Top 15 in the leader board',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'SCORER-TECHNICIAN',
                'badge_description' => 'Rewarded for members who are in Top 10 in the leader board',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'SCORING MACHINE',
                'badge_description' => 'Rewarded for members who are in Top 5 in the leader board',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'ORGANIZER',
                'badge_description' => 'Rewarded for those who avails locker',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'BOOSTER',
                'badge_description' => 'Reward for those who have helped other members on their workout',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'GRINDER',
                'badge_description' => 'Rewarded for those who gained 2 or more levels in one day',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'OPEN MINDED',
                'badge_description' => 'Rewarded for those who recruited a new member',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'MAC ARTHUR',
                'badge_description' => 'Rewarded for those who re-subscribed to the gym after being inactive for 3 months',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'SECOND HOME',
                'badge_description' => 'Rewarded for those that have logged a total of  72 hours in the gym',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'YOUR DAY',
                'badge_description' => 'Rewarded for those members that have logged in during their birthday',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'EARLY BIRD',
                'badge_description' => 'Rewarded for being logging in during the first 30 minutes of opening',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'OWLER',
                'badge_description' => 'Rewarded for those who logged out 30 minutes before closing',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			],
			[
				'badge_name' => 'ON A ROLL',
                'badge_description' => 'Rewarded for those who have gained the highest points for the day',
                'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			]
    );
        DB::table('badges')->insert($badges);
    }
}
