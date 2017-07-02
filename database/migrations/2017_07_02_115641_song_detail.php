<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::create('song_detail', function (Blueprint $table) {
            $table->increments('id');


            $table->integer("song_id")->unsigned();
            $table->foreign("song_id")
                ->references('id')
                ->on('song')
                ->onDelete('cascade')
                ->onUpdate('cascade');



            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('title');

            $table->string('embedUrl');

            $table->string('description');


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
        Schema::dropIfExists('song_detail');
    }
}
