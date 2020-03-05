<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinkMonitoringTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('link_monitoring', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('monitor_link_id', 128);
			$table->string('monitor_type', 32)->default('');
			$table->string('ip_address', 32)->default('');
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
		Schema::drop('link_monitoring');
	}

}
