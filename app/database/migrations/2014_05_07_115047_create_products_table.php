<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('products', function (Blueprint $table){
      $table->increments('id');
      $table->integer('category_id')->unsigned()->index();
      $table->string('title')->index();
      $table->text('description');
      $table->decimal('price', 10, 2);
      $table->float('tax')->default(20);
      $table->boolean('availability')->default(1);
      $table->boolean('featured')->default(0);
      $table->string('image');
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
		Schema::drop('products');
	}

}
