<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAffiliateAdsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliate_ads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('affiliate_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->integer('company_id')->unsigned()->nullable();
			$table->text('message', 65535)->nullable();
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
		Schema::drop('affiliate_ads');
	}

}
