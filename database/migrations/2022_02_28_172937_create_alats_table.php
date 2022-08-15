<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alats', function (Blueprint $table) {
            $table->increments('alat_id', 255);
            $table->integer('engineer_id')->unsigned();
            $table->foreign('engineer_id')->references('user_id')->on('users');
            $table->string('nomorserial'); #list untuk nomer serial buat check apakah nomor serial ada didatabase saat registrasi user
            $table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alats');
    }
}
