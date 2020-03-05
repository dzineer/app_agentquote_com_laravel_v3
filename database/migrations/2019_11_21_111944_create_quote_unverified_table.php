<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuoteUnverifiedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quote_unverified', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('email', 128);
			$table->string('phone', 60)->default('');
			$table->string('name', 128);
			$table->string('token', 128)->default('');
			$table->string('domain', 128);
			$table->text('data', 65535);
			$table->string('code', 128)->nullable();
			$table->integer('attempts')->default(0);
			$table->integer('locked')->default(1);
			$table->dateTime('expires_at');
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
		Schema::drop('quote_unverified');
	}

}
