<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    DB::statement("ALTER TABLE assignments CHANGE assignment assignment ENUM('owner', 'member', 'reviewer', 'author')");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    DB::statement("ALTER TABLE assignments CHANGE assignment assignment ENUM('owner', 'member', 'reviewer')");
	}

}
