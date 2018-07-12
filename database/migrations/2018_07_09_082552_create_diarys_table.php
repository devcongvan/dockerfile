<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiarysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diarys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('d_cantype_id');
            $table->integer('d_can_id');
            $table->string('d_evaluate')->nullable();
            $table->string('d_set_calendar')->nullable();
            $table->string('d_set_time')->nullable();
            $table->string('d_notice_before')->nullable();
            $table->string('d_note')->nullable();
            $table->string('d_breaktime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diarys');
    }
}
