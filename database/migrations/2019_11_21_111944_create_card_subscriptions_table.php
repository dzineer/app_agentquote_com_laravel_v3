<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card_subscriptions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('expiry_month', 191)->nullable();
			$table->string('payment_gateway', 191)->nullable();
			$table->string('last_four_digits', 191)->nullable();
			$table->string('card_id', 191)->nullable();
			$table->string('expiry_year', 191)->nullable();
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
		Schema::drop('card_subscriptions');
	}

}
