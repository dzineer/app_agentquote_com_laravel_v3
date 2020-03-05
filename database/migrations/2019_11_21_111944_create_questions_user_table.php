<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions_user', function(Blueprint $table)
		{
			$table->integer('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('question_1', 191);
			$table->string('question_2', 191);
			$table->string('question_3', 191);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions_user');
	}

}
