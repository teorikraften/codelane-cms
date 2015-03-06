<?php

class AddPmTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard(); // Allow mass assignment

		foreach(range(1, 10) as $index)
		{
			Pm::create(['title' => 'TestPM' . $index, 
				'content' => 'Jag är ett test PM Nummer: ' . $index,
				'created_by' => User::find(($index - 1) % 3 + 1)->id,
				'verified' => true
				]);
		}

		$this->command->info('10 PMs seeded');

		foreach (range(1, 25) as $value) {
			Tag::create( ['name' => $value]	);
		}

		$this->command->info('25 Tags seeded');

		//  Adding pm_tags
		foreach (range(1, 25) as $value) {
			$pm = PM::find((($value - 1 ) %  10) + 1);
			$tag = Tag::find($value);
			$pm->tags()->attach([$value => ['added_by' => 1]]);
			$pm->save();
		}

		$this->command->info('25 pm_tags seeded Example PM 1 has tag 1, 11, 21');

	}

}