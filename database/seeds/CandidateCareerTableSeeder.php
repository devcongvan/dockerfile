<?php

use Illuminate\Database\Seeder;

class CandidateCareerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit=1000;

        for ($i=1;$i<=$limit;$i++){
            for ($j=1;$j<=5;$j++){
                DB::table('candidates_careers')->insert([
                    "cc_candidates_id" => $i,
                    "cc_careers_id"    =>rand(1,93)
                ]);
            }
        }

    }
}
