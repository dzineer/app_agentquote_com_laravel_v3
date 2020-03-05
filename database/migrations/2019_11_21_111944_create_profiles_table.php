<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('contact_email', 191)->nullable();
			$table->string('logo', 191)->nullable();
			$table->string('portrait', 191)->nullable();
			$table->string('company', 191)->nullable();
			$table->string('contact_phone', 191)->nullable();
			$table->string('contact_addr1', 191)->nullable();
			$table->string('contact_addr2', 191)->nullable();
			$table->string('contact_city', 191)->nullable();
			$table->string('contact_state', 191)->nullable();
			$table->string('contact_zip', 191)->nullable();
			$table->string('position_title', 191)->nullable();
			$table->string('facebook_link', 191)->nullable();
			$table->string('twitter_link', 191)->nullable();
			$table->string('youtube_link', 191)->nullable();
			$table->string('linkedin_link', 191)->nullable();
			$table->string('instagram_link', 191)->nullable();
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
		Schema::drop('profiles');
	}

}
