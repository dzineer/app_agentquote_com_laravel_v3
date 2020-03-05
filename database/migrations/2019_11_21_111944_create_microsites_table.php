<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMicrositesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('microsites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('subdomain_id')->unsigned()->nullable();
			$table->integer('default_category_id')->unsigned()->nullable()->default(0);
			$table->integer('profile_id')->unsigned()->nullable();
			$table->boolean('show_logo')->default(0);
			$table->boolean('show_portrait')->default(0);
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
		Schema::drop('microsites');
	}

}
