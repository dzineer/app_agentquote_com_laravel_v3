<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCarriersPopularTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('carriers_popular', function(Blueprint $table)
		{
			$table->foreign('company_id', 'carriers_popular_ibfk_1')->references('company_id')->on('carriers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('carriers_popular', function(Blueprint $table)
		{
			$table->dropForeign('carriers_popular_ibfk_1');
		});
	}

}
