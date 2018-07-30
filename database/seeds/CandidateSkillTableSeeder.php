<?php

use Illuminate\Database\Seeder;

class CandidateSkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $limit = 1000;

        for ($i = 1; $i <= $limit; $i++)
        {
            for ($j = 1; $j <= 3; $j++)
            {
                DB::table('candidates_skills')->insert([
                    "cs_candidates_id" => $i,
                    "cs_skills_id"    => rand(12,24)
                ]);
            }
        }
    }
}
