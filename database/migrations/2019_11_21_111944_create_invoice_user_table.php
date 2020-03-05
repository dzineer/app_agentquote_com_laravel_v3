<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoiceUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('number', 191);
			$table->string('invoice_id', 191);
			$table->string('invoice_date', 191);
			$table->string('customer_id', 191);
			$table->string('status', 191);
			$table->string('currency_code', 191);
			$table->string('sub_total', 191);
			$table->string('total', 191);
			$table->string('customer_name', 191);
			$table->text('invoice_url', 65535);
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
		Schema::drop('invoice_user');
	}

}
