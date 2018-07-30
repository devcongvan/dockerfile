<?php

use Illuminate\Database\Seeder;

class WorkplaceTableSeeder extends Seeder
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
            for ($j=1;$j<=4;$j++){
                DB::table('workplaces')->insert([
                    "wp_candidates_id" => $i,
                    "wp_locations_id"  => rand(1,500)
                ]);
            }
        }
    }
}
