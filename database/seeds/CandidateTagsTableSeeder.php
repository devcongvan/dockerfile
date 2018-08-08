<?php

use Illuminate\Database\Seeder;

class CandidateTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $limit = 1000;

        for ($i = 0; $i < $limit; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                DB::table('candidate_tags')->insert([
                    'candidate_id' => $i,
                    'candidate_tag_id'       => rand(1,39606),
                    'candidate_tag_type'      => 'App\Model\Location'
                ]);
            }
        }
    }
}
