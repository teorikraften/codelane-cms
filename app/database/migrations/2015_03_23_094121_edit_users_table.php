<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    DB::statement("ALTER TABLE users CHANGE privileges privileges ENUM('unverified', 'verified', 'pm-admin', 'admin')");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    DB::statement("ALTER TABLE users CHANGE privileges privileges ENUM('unverified', 'verified', 'admin')");
	}

}
