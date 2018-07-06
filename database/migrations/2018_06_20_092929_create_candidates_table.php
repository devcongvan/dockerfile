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
            $table->string('can_name')->nullable();
            $table->date('can_birthday')->nullable();
            $table->integer('can_year')->nullable();
            $table->integer('can_gender')->nullable();
            $table->text('can_avatar')->nullable();
            $table->integer('can_phone')->nullable();
            $table->string('can_email')->nullable();
            $table->string('can_address')->nullable();
            $table->string('hometown')->nullable();
            $table->string('can_skype')->nullable();
            $table->string('can_facebook')->nullable();
            $table->string('can_linkedin')->nullable();
            $table->string('can_github')->nullable();
            $table->integer('can_source_id')->nullable();
            $table->string('can_title')->nullable();

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
