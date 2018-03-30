<?php

use App\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('password')->nullable();
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('events', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('icon');
			$table->date('date');
			$table->timestamps();
		});

		Schema::create('events_users', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedInteger('event_id');
			$table->unsignedInteger('user_id');
		});

		$this->populateEvents();
	}

	public function down()
	{
		Schema::dropIfExists('events_users');
		Schema::dropIfExists('events');
		Schema::dropIfExists('users');
	}

	protected function populateEvents()
	{
		$events = [
			['name' => 'Bridal Shower', 'icon' => 'bridal-shower', 'date' => '2018-06-30'],
			['name' => 'Bachelorette Party', 'icon' => 'bachelorette-party', 'date' => '2018-07-21'],
			['name' => 'Bachelor Party', 'icon' => 'bachelor-party', 'date' => '2018-09-06'],
			['name' => 'Rehearsal Dinner', 'icon' => 'rehearsal-dinner', 'date' => '2018-09-07'],
			['name' => 'Ceremony &amp; Reception', 'icon' => 'wedding', 'date' => '2018-09-08'],
			['name' => 'Day-After Brunch', 'icon' => 'brunch', 'date' => '2018-09-09'],
		];

		foreach ($events as $event) {
			Event::create($event);
		}
	}
}
