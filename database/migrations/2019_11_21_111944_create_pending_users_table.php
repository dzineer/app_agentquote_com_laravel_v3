<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendingUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pending_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('confirmation_id')->unsigned();
			$table->integer('type_id')->unsigned();
			$table->string('email', 191)->default('');
			$table->string('fname', 191)->default('');
			$table->string('lname', 191)->default('');
			$table->timestamps();
			$table->dateTime('expires_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pending_users');
	}

}
