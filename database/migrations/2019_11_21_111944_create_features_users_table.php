<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeaturesUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('features_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('feature_id')->unsigned()->index('feature_id');
			$table->integer('user_id')->unsigned()->index('user_id');
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
		Schema::drop('features_users');
	}

}
