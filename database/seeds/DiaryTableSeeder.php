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
        for ($i=0;$i<50;$i++){
            DB::table('diarys')->insert([
                'd_cantype_id' => rand(1,6),
                'd_can_id' => 31,
                'd_set_calendar' => rand(1,100000000),
                'd_set_calendar' => rand(1,100000000),
                'd_set_time' => rand(1,100000000),
                'd_notice_before' => rand(1,100000000),
                'd_note' => str_random('100'),
                'created_at' => now()->format('Y-m-d H:i:s')
            ]);
        }

    }
}
