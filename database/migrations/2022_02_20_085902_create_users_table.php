<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

		$table->increments('user_id', 255);
		$table->string('username');
		$table->string('email');
		$table->string('nomer');
		$table->string('password');
		$table->string('gambar')->nullable();
		$table->enum('rules',['admin','user','engineer','']);
		$table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
		$table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
