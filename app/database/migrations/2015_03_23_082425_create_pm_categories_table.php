<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pm_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pm')->unsigned();
			$table->foreign('pm')->references('id')->on('pms');
			$table->integer('category')->unsigned();
			$table->foreign('category')->references('id')->on('categories');
			$table->integer('added_by')->unsigned();
			$table->foreign('added_by')->references('id')->on('users');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pm_categories');
	}

}
