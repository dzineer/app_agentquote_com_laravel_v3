<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('fname', 191);
			$table->string('lname', 191);
			$table->string('email', 191);
			$table->string('addr1', 191);
			$table->string('addr2', 191);
			$table->string('city', 191);
			$table->string('state', 191);
			$table->string('zipcode', 191);
			$table->string('primary_phone', 191);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contacts_user');
	}

}
