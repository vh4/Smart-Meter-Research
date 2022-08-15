<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {

		$table->integer('email_id',255);
        $table->string('nomorserial_id', 255);
        $table->foreign('nomorserial_id')->references('nomorserial_id')->on('nomorserials')->onDelete('cascade')->onUpdate('cascade');
		$table->string('subject')->nullable()->default('NULL');
		$table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('emails');
    }
}