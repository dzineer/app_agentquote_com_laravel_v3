<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarrierGuidesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carrier_guides', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->unsigned()->index('fk_carrier');
			$table->string('name', 191)->nullable();
			$table->string('url', 191)->nullable();
			$table->string('guide_title', 191)->nullable();
			$table->integer('category_id')->unsigned()->index('fk_category');
			$table->string('product', 191)->nullable();
			$table->integer('preferred')->default(0);
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
		Schema::drop('carrier_guides');
	}

}
