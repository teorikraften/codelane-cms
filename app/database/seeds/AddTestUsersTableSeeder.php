<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AddTestUsersTableSeeder extends Seeder {

	public function run()
	{
		User::create(['email' => 'testo@jdahl.se', 'real_name' => 'Overifierad Lantz', 'privileges' => 'unverified', 'password' => Hash::make('o')]);
		User::create(['email' => 'testv@jdahl.se', 'real_name' => 'Verifierad Dahl', 'privileges' => 'verified', 'password' => Hash::make('v')]);
		User::create(['email' => 'testa@jdahl.se', 'real_name' => 'Admin Jonasson', 'privileges' => 'admin', 'password' => Hash::make('a')]);
	}

}