<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateForgetsTable extends Migration
{
    public function up()
    {
        Schema::create('forgets', function (Blueprint $table) {

		$table->increments('forget_id');
        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->string('token');
		$table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('forgets');
    }
}
