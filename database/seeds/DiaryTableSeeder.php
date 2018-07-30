<?php

use Illuminate\Database\Seeder;

class DiaryTableSeeder extends Seeder
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

        $arr=[null,1,2,3,4,5];

        for ($i=1;$i<=$limit;$i++){
            $randomKey=array_rand($arr);
            for ($j = 1; $j <= 2; $j++)
            {
                DB::table('diarys')->insert([
                    'd_cantype_id'    => rand(1, 6),
                    'd_can_id'        => $i,
                    'd_evaluate'=> $arr[$randomKey],
                    'd_set_calendar'  => $faker->date(),
                    'd_set_time'      => $faker->time(),
                    'd_notice_before' => $faker->text,
                    'd_note'          => $faker->realText(),
                    'created_at'      => now()->format('Y-m-d H:i:s')
                ]);
            }
        }


    }
}
