<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('author');
			$table->text('body');
			$table->string('tags')->nullable();
			$table->string('category')->nullable();
			$table->bigInteger('hearts')->nullable();
			$table->text('coverpic')->nullable();
			$table->string('slug');
			$table->string('title');
			$table->integer('user_id')->unsigned()->nullable();
			
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
