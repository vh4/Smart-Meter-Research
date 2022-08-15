<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorytokensTable extends Migration
{
    public function up()
    {
        Schema::create('historytokens', function (Blueprint $table) {

		$table->integer('historytoken_id',10)->unsigned();
        $table->string('nomorserial_id', 255);
        $table->foreign('nomorserial_id')->references('nomorserial_id')->on('nomorserials')->onDelete('cascade')->onUpdate('cascade');
		$table->string('token');
		$table->enum('status',['sukses','gagal']);
		$table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));


        });
    }

    public function down()
    {
        Schema::dropIfExists('historytokens');
    }
}