<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuotesUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotes_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('affiliate_id')->nullable();
			$table->integer('user_id');
			$table->integer('age');
			$table->string('age_or_date', 8)->default('');
			$table->string('state', 60)->default('');
			$table->integer('month');
			$table->integer('day');
			$table->integer('year');
			$table->string('gender', 4)->default('');
			$table->integer('term');
			$table->string('tobacco', 2)->default('');
			$table->float('benefit', 10, 0);
			$table->integer('period');
			$table->integer('category');
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
		Schema::drop('quotes_user');
	}

}
