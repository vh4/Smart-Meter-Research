<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNomorserialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomorserials', function (Blueprint $table) {

            $table->string('nomorserial_id', 255);
            $table->primary('nomorserial_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('nomorserials');
    }
}
