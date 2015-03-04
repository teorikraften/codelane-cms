<?php

class AddPmTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();

		foreach(range(1, 10) as $index)
		{
			Pm::create(['title' => 'TestPM' . $index, 
				'content' => 'Jag är ett test PM Nummer: ' . $index
			]);
		}
	}

}