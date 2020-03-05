<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfirmationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('confirmations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->text('confirmation_token', 65535);
            $table->timestamp('expires_at');
            $table->integer('confirmation_type');
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
		Schema::drop('confirmations');
	}

}
