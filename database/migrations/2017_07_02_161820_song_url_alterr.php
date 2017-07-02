<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongUrlAlterr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song', function (Blueprint $table) {

            $table->text('imageUrl')->default('https://pbs.twimg.com/profile_images/710468502457442304/f-8UB2T1.jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('song', function (Blueprint $table) {
            //
        });
    }
}
