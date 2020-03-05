<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoiceItemUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_item_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('item_id', 191);
			$table->string('invoice_id', 191);
			$table->string('code', 191);
			$table->string('quantity', 191);
			$table->string('discount_amount', 191);
			$table->string('tax_name', 191);
			$table->string('description', 191);
			$table->string('item_total', 191);
			$table->string('tax_id', 191);
			$table->string('tax_type', 191);
			$table->string('price', 191);
			$table->string('product_id', 191);
			$table->string('account_name', 191);
			$table->string('name', 191);
			$table->string('tax_percentage', 191);
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
		Schema::drop('invoice_item_user');
	}

}
