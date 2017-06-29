<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



DEFINE('ALAT_MUSIK','alatMusik');
class AlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string(ALAT_MUSIK)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usesr', function (Blueprint $table) {
            $table->dropColumn(ALAT_MUSIK);
        });
    }
}
