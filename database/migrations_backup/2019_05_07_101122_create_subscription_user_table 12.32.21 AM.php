<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subscription_id', 191)->nullable();
			$table->string('user_id', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->string('next_billing_at', 191)->nullable();
			$table->string('product_id', 191)->nullable();
			$table->string('interval_unit', 191)->nullable();
			$table->string('amount', 191)->nullable();
			$table->string('currency_symbol', 191)->nullable();
			$table->string('product_name', 191)->nullable();
			$table->string('auto_collect', 191)->nullable();
			$table->string('sub_total', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->string('customer_id', 191)->nullable();
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
		Schema::drop('subscription_user');
	}

}
