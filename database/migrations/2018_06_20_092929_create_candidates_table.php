<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('can_name');
            $table->date('can_birthday');
            $table->integer('can_gender');
            $table->text('can_avatar');
            $table->integer('can_phone');
            $table->string('can_email');
            $table->string('can_address');
            $table->integer('can_location_id');
            $table->string('can_skype');
            $table->string('can_facebook');
            $table->string('can_linkedin');
            $table->string('can_github');
            $table->integer('can_source_id');

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
        Schema::dropIfExists('candidates');
    }
}
