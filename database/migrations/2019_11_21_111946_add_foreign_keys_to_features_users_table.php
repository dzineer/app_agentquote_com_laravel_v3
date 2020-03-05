<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFeaturesUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('features_users', function(Blueprint $table)
		{
			$table->foreign('user_id', 'features_users_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('feature_id', 'features_users_ibfk_2')->references('id')->on('features')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('features_users', function(Blueprint $table)
		{
			$table->dropForeign('features_users_ibfk_1');
			$table->dropForeign('features_users_ibfk_2');
		});
	}

}
