<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterScheduleCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule', function (Blueprint $table) {
            //

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule', function (Blueprint $table) {
            //
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
