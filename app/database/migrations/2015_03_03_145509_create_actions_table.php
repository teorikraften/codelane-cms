<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user')->unsigned();
			$table->foreign('user')->references('id')->on('users');
			$table->integer('pm')->unsigned();
			$table->foreign('pm')->references('id')->on('pms');
			$table->integer('old_pm')->unsigned();
			$table->foreign('old_pm')->references('id')->on('old_pms');
			$table->enum('action_type', array('')); // TODO
			// TODO
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
		Schema::drop('actions');
	}

}
