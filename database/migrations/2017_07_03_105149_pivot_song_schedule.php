<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotSongSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_song', function (Blueprint $table) {

            $table->dropColumn('id');
            $table->dropColumn('song_id');
            $table->dropColumn('schedule_id');


            $table->integer('song_id')->unsigned()->nullable();
            $table->foreign('song_id')
                ->references('id')
                ->on('song')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('schedule_id')->unsigned()->nullable();
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedule')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->primary(['song_id', 'schedule_id'])->unsigned()->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_song', function (Blueprint $table) {
            //
            // $table->dropForeign( ['schedule_song_song_id_foreign',"schedule_song_schedule_id_foreign" ]);
            $table->dropForeign('schedule_song_song_id_foreign');
            $table->dropForeign("schedule_song_schedule_id_foreign" );
            // $table->dropPrimary(['song_id','schedule_id']);
            $table->dropColumn('song_id');
            $table->dropColumn('schedule_id');
            // $table->integer('song_id')->unsigned()->nullable();
            // $table->integer('schedule_id')->unsigned()->nullable();
            // $table->increments('id');

        });
    }
}
