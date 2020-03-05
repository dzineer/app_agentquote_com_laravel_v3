<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarriersCategoryUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carriers_category_users', function(Blueprint $table)
		{
			$table->integer('category_id')->unsigned();
			$table->integer('user_id');
			$table->integer('company_id');
			$table->unique(['category_id','user_id','company_id'], 'category_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carriers_category_users');
	}

}
