<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeadsUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leads_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lead_id', 191);
			$table->integer('user_id');
			$table->integer('contact_id');
			$table->integer('quote_id');
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
		Schema::drop('leads_user');
	}

}
