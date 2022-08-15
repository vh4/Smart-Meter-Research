<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTokensTable extends Migration
{
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {

		$table->increments('token_id', 255);
        $table->string('nomorserial_id', 255);
        $table->foreign('nomorserial_id')->references('nomorserial_id')->on('nomorserials')->onDelete('cascade')->onUpdate('cascade');
        $table->string('token')->nullable();
        $table->integer('trigger')->nullable();
		$table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
