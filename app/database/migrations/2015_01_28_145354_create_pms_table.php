<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 150);
			$table->text('content');
			$table->string('original_filetype', 10);
			$table->string('token', 150);
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
		Schema::drop('pms');
	}

}
