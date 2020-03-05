<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('email', 191)->unique();
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('fname', 191)->nullable();
			$table->string('lname', 191)->nullable();
			$table->string('time_zone', 191)->nullable();
			$table->integer('type_id')->default(5);
			$table->integer('affiliate_id')->nullable();
			$table->integer('typeable_id')->nullable();
			$table->string('typeable_type', 191)->nullable();
			$table->integer('active')->nullable()->default(1);
			$table->dateTime('last_login_at')->nullable();
			$table->dateTime('login_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
