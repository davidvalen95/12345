<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotSchedileDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_song_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('schedule_id')->unsigned();
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedule')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('song_detail_id')->unsigned();
            $table->foreign('song_detail_id')
                ->references('id')
                ->on('song_detail')
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
        Schema::dropIfExists('schedule_song_detail');
    }
}
