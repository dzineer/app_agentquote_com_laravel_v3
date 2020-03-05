<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAnalyticsCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_analytics_codes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('domain', 128);
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('type')->unsigned()->nullable()->default(1);
			$table->text('data', 65535)->nullable();
			$table->integer('status')->default(1);
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
		Schema::drop('user_analytics_codes');
	}

}
