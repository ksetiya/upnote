<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('author');
			$table->text('body');
			$table->integer('post_id')->unsigned()->nullable(); //the post ID that the comment belongs to
			$table->bigInteger('upvotes'); 
			//$table->integer('user_id')->unsigned();
			$table->integer('user_id')->unsigned();
			
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
