<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountQuoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_quote', function(Blueprint $table)
		{
			$table->increments('id')->comment('primary key');
			$table->string('hostname');
			$table->string('endpoint');
			$table->string('client_id', 32);
			$table->string('password', 64);
			$table->string('site_num', 16);
			$table->string('grant_type', 20);
			$table->string('client_secret', 128);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('account_quote');
	}

}
