<?php

use Illuminate\Database\Seeder;

class CandidateInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 1000;

        for ($i = 1; $i <= $limit; $i++)
        {
            $salary_rand = rand(5,30);

            DB::table('candidates_infos')->insert([
                "ci_candidates_id"   => $i,
                "ci_work_abroad"     => rand(0, 1),
                "ci_time_experience" => rand(0, 7),
                "ci_qualification"   => rand(0, 6),
                "ci_english_level"   => rand(0, 4),
                "ci_type_of_work"    => rand(0, 2),
                "ci_salary_from"     => $salary_rand - 4,
                "ci_salary_to"       => $salary_rand,
                "ci_target"          => $faker->text,
                "ci_about"           => $faker->text,
                "ci_work_experience" => '',
                "ci_education"       => '',
                "ci_activity"        => '',
                "ci_certificate"     => '',
                "ci_prize"           => '',
                "ci_skill"           => '',
                "ci_hobby"           => '',
                "created_at"         => $faker->dateTime
            ]);
        }

    }
}
