<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePmTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pm_tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pm')->unsigned();
			$table->foreign('pm')->references('id')->on('pms');
			$table->integer('tag')->unsigned();
			$table->foreign('tag')->references('id')->on('tags');
			$table->integer('added_by')->unsigned();
			$table->foreign('added_by')->references('id')->on('users');
			$table->softDeletes();
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
		Schema::drop('pm_tags');
	}

}
