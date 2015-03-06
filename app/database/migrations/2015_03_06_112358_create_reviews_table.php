<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pm')->unsigned();
			$table->foreign('pm')->references('id')->on('pms');
			$table->integer('user')->unsigned();
			$table->foreign('user')->references('id')->on('users');
			$table->integer('comment')->unsigned();
			$table->foreign('comment')->references('id')->on('comments');
			$table->boolean('accepted');
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
		Schema::drop('reviews');
	}

}
