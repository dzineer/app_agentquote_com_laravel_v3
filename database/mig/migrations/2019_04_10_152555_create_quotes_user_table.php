<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuotesUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotes_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('birthdate', 191);
			$table->string('gender', 191);
			$table->string('smoker', 191);
			$table->string('product_category', 191);
			$table->integer('term');
			$table->string('coverage', 191);
			$table->integer('company_id');
			$table->string('product_id', 191);
			$table->string('premium_monthly', 191);
			$table->string('premium_quarterly', 191);
			$table->string('premium_semiannually', 191);
			$table->string('premium_annually', 191);
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
		Schema::drop('quotes_user');
	}

}
