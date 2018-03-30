<?php

use App\User;
use App\Event;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = [
			['first_name' => 'David', 'last_name' => 'VanScott', 'events' => '*'],
			['first_name' => 'Leah', 'last_name' => 'George', 'events' => '*'],
			['first_name' => 'Daryl', 'last_name' => 'Donatelli', 'events' => 'Bachelor Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Jennifer', 'last_name' => 'Donatelli', 'events' => 'Bachelorette Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'James', 'last_name' => 'Santimaw', 'events' => 'Bachelor Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Sammi', 'last_name' => 'Santimaw', 'events' => 'Bachelorette Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Holly', 'last_name' => 'Plymale', 'events' => 'Bachelorette Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Todd', 'last_name' => 'Plymale', 'events' => 'Rehearsal Dinner|Wedding'],
			['first_name' => 'Andrea', 'last_name' => 'Johns', 'events' => 'Bachelorette Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Ben', 'last_name' => 'Johns', 'events' => 'Rehearsal Dinner|Wedding'],
			['first_name' => 'Bryon', 'last_name' => 'George', 'events' => 'Bachelor Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Jason', 'last_name' => 'George', 'events' => 'Bachelor Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Jen', 'last_name' => 'George', 'events' => 'Bachelorette Party|Rehearsal Dinner|Wedding'],
			['first_name' => 'Angela', 'last_name' => 'George', 'events' => 'Bachelorette Party|Rehearsal Dinner|Wedding'],
		];

		$allEvents = Event::get();

		foreach ($users as $user) {
			$events = explode('|', $user['events']);
			unset($user['events']);

			$newUser = User::create($user);

			if ($events[0] != '*') {
				$filteredEvents = $allEvents->whereIn('name', $events);
			} else {
				$filteredEvents = $allEvents;
			}

			$newUser->events()->sync($filteredEvents->pluck('id'));
		}
	}
}
