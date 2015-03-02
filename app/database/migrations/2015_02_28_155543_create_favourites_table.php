<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavouritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favourites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user')->unsigned();
			$table->foreign('user')->references('id')->on('users');
			$table->integer('pm')->unsigned();
			$table->foreign('pm')->references('id')->on('pms');
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
		Schema::drop('favourites');
	}

}
