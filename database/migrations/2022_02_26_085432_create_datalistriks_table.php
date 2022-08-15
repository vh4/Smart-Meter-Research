<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDatalistriksTable extends Migration
{
    public function up()
    {
        Schema::create('datalistriks', function (Blueprint $table) {

		$table->increments('listrik_id', 255);
        $table->string('nomorserial_id', 255);
        $table->foreign('nomorserial_id')->references('nomorserial_id')->on('nomorserials')->onDelete('cascade')->onUpdate('cascade');
		$table->float('sisa_pulsa')->nullable();
		$table->float('sisa_pulsa_n-1')->nullable();
		$table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));

        });

        Schema::table('datalistriks', function($table) {
        });


    }

    public function down()
    {
        Schema::dropIfExists('datalistriks');
    }
}
