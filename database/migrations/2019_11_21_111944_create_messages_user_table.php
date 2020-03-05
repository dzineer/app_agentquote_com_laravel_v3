<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('message_type_id');
			$table->integer('originator_id');
			$table->integer('user_id');
			$table->text('subject', 65535);
			$table->text('body', 65535);
			$table->boolean('acknowledged')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages_user');
	}

}
