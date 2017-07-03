<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScheduleSong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_song', function (Blueprint $table) {
            $table->increments('id');

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
        Schema::dropIfExists('schedule_song');
    }
}
