<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualsTable extends Migration
{
    public function up()
    {
        Schema::create('actuals', function (Blueprint $table) {

        $table->increments('actual_id');
        $table->string('nomorserial_id', 255);
        $table->foreign('nomorserial_id')->references('nomorserial_id')->on('nomorserials')->onDelete('cascade')->onUpdate('cascade');
		$table->float('pemakaian_listrik')->nullable();
		$table->datetime('tanggal');

        });
    }

    public function down()
    {
        Schema::dropIfExists('actuals');
    }
}
