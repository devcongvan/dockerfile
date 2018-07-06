<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates_infos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ci_candidates_id')->nullable();
            $table->integer('ci_work_abroad')->nullable();
            $table->integer('ci_time_experience')->nullable();
            $table->integer('ci_qualification')->nullable();
            $table->integer('ci_english_level')->nullable();
            $table->integer('ci_type_of_work')->nullable();
            $table->integer('ci_salary')->nullable();
            $table->text('ci_target')->nullable();
            $table->text('ci_about')->nullable();
            $table->text('ci_work_experience')->nullable();
            $table->text('ci_education')->nullable();
            $table->text('ci_activity')->nullable();
            $table->text('ci_certificate')->nullable();
            $table->text('ci_prize')->nullable();
            $table->text('ci_skill')->nullable();
            $table->text('ci_hobby')->nullable();

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
        Schema::dropIfExists('candidate_infos');
    }
}
