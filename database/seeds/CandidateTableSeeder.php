<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Testing\Fakes;

class CandidateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create();

        $limit=1000;

        for ($i = 0; $i<$limit; $i++)
        {

            DB::table('candidates')->insert([
                'can_name'      => $faker->name,
                'can_birthday'  => $faker->dateTimeBetween('-18year'),
                'can_gender'    => rand(0, 1),
                'can_avatar'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Missing_avatar.svg/2000px-Missing_avatar.svg.png',
                'can_phone'     => $faker->phoneNumber,
                'can_email'     => $faker->unique()->email,
                'can_address'   => $faker->address,
                'hometown'      => $faker->address,
                'can_skype'     => 'http://skype.com/' . str_random(10),
                'can_facebook'  => 'http://facebook.com' . str_random(10),
                'can_linkedin'  => 'http://linkedin.com/' . str_random(10),
                'can_github'    => 'http://github.com/' . str_random(10),
                'can_source_id' => rand(3, 19),
                'can_title'     => $faker->title,
                'can_year'      => rand(1980, 2002),
                'created_at'=>$faker->dateTime(),
                'updated_at'=>$faker->dateTime()
            ]);
        }

    }
}
