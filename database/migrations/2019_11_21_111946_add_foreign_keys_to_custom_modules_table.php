<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCustomModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('custom_modules', function(Blueprint $table)
		{
			$table->foreign('module_type_id', 'custom_modules_ibfk_1')->references('id')->on('module_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('custom_modules', function(Blueprint $table)
		{
			$table->dropForeign('custom_modules_ibfk_1');
		});
	}

}
