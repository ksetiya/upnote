<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
		});
		
		Schema::create('post_tag', function(Blueprint $table) //pivot table
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->integer('post_id')->unsigned()->index();
			$table->integer('tag_id')->unsigned()->index();
			
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
		Schema::drop('post_tag');
	}

}
