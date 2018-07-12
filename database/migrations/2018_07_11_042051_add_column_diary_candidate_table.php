<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDiaryCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('candidates',function (Blueprint $table){
                $table->text('can_diary');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            if (Schema::hasColumn('candidates', 'can_diary')) {
                Schema::table('candidates',function (Blueprint $table){
                    $table->dropColumn('can_diary');
                });
            }
    }
}
