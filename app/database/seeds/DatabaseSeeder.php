<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		User::create(['email' => 'testo@jdahl.se', 'real_name' => 'Overifierad Lantz', 'privileges' => 'unverified', 'password' => Hash::make('o')]);
		User::create(['email' => 'testv@jdahl.se', 'real_name' => 'Verifierad Dahl', 'privileges' => 'verified', 'password' => Hash::make('v')]);
		User::create(['email' => 'testa@jdahl.se', 'real_name' => 'Admin Jonasson', 'privileges' => 'admin', 'password' => Hash::make('a')]);

		
		// $this->call('UserTableSeeder');
	}

}
