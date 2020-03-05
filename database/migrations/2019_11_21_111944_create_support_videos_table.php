<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('support_videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('caption', 191)->nullable();
			$table->string('url', 191)->nullable();
			$table->string('image', 191)->nullable();
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
		Schema::drop('support_videos');
	}

}
