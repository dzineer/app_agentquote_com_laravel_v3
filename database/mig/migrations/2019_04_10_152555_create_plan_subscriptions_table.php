<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plan_subscriptions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('plan_code', 191)->nullable();
			$table->string('name', 191);
			$table->string('quantity', 191)->nullable();
			$table->string('price', 191)->nullable();
			$table->string('discount', 191)->nullable();
			$table->string('total', 191)->nullable();
			$table->string('setup_fee', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->string('tax_id', 191)->nullable();
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
		Schema::drop('plan_subscriptions');
	}

}
