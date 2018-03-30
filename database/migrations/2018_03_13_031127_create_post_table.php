<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
	public function up()
	{
		Schema::create('posts', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('event_id');
			$table->unsignedInteger('user_id');
			$table->text('caption')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});

		Schema::create('media', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('post_id');
			$table->string('filename');
			$table->string('mime_type');
			$table->softDeletes();
			$table->timestamps();
		});

		Schema::create('comments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('commentable_id');
			$table->string('commentable_type', 50);
			$table->text('body');
			$table->timestamps();

			$table->unique(['user_id', 'commentable_id', 'commentable_type']);
		});

		Schema::create('favorites', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('favorited_id');
			$table->string('favorited_type', 50);
			$table->timestamps();

			$table->unique(['user_id', 'favorited_id', 'favorited_type']);
		});
	}

	public function down()
	{
		Schema::dropIfExists('favorites');
		Schema::dropIfExists('comments');
		Schema::dropIfExists('media');
		Schema::dropIfExists('posts');
	}
}
