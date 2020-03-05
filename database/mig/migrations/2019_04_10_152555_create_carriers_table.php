<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarriersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carriers', function(Blueprint $table)
		{
			$table->increments('id')->comment('primary key');
			$table->integer('company_id')->unsigned()->unique('company_id');
			$table->string('name', 256);
			$table->string('link1', 256)->nullable();
			$table->string('link2', 256)->nullable();
			$table->integer('active');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carriers');
	}

}
