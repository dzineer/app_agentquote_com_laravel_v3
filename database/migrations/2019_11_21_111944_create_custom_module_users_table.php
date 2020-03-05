<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomModuleUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custom_module_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('custom_module_id')->unsigned()->index('custom_module_id');
			$table->integer('user_id')->unsigned()->nullable()->index('user_id');
			$table->text('data', 65535)->nullable();
			$table->integer('status')->default(1);
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
		Schema::drop('custom_module_users');
	}

}
