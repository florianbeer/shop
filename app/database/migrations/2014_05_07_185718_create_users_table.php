<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('firstname')->index();
      $table->string('lastname')->index();
      $table->string('email')->unique();
      $table->string('password', 60);
      $table->string('street');
      $table->string('number');
      $table->string('zip');
      $table->string('city');
      $table->string('country');
      $table->boolean('admin')->default(0);
      $table->string('remember_token', 100)->nullable();
      $table->timestamps();
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
