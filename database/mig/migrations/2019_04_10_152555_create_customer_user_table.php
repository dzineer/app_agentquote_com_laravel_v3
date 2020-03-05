<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->string('customer_id', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('first_name', 191)->nullable();
			$table->string('billing_address_street', 191)->nullable();
			$table->string('billing_address_street2', 191)->nullable();
			$table->string('billing_address_country', 191)->nullable();
			$table->string('billing_address_city', 191)->nullable();
			$table->string('billing_address_state', 191)->nullable();
			$table->string('billing_address_zip', 191)->nullable();
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
		Schema::drop('customer_user');
	}

}
