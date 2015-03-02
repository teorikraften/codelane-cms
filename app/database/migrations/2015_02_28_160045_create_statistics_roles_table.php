<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatisticsRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statistics_roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('statistics')->unsigned();
			$table->foreign('statistics')->references('id')->on('statistics');
			$table->integer('role')->unsigned();
			$table->foreign('role')->references('id')->on('roles');
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
		Schema::drop('statistics_roles');
	}

}
