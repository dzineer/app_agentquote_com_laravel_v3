<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHashCustomModuleUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hash_custom_module_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('custom_modules_user_id');
			$table->string('hash_id', 128);
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
		Schema::drop('hash_custom_module_users');
	}

}
