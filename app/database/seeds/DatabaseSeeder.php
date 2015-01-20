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

		$this->call('GroupTaskSeeder');
		$this->call('GroupSeeder');
		$this->call('PeriodicitySeeder');
		$this->call('TaskSeeder');
		$this->call('TimeIndexSeeder');
		$this->call('AccumulationSeeder');
		$this->call('HolidaySeeder');
	}

}
