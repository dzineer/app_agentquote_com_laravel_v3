<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarriersSiwlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carriers_siwl', function(Blueprint $table)
		{
			$table->integer('category_id')->unsigned()->comment('primary key');
			$table->integer('user_id');
			$table->integer('company_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carriers_siwl');
	}

}
