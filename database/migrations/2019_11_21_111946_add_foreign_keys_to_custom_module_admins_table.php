<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCustomModuleAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('custom_module_admins', function(Blueprint $table)
		{
			$table->foreign('custom_module_id', 'custom_module_admins_ibfk_1')->references('id')->on('custom_modules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'custom_module_admins_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('custom_module_admins', function(Blueprint $table)
		{
			$table->dropForeign('custom_module_admins_ibfk_1');
			$table->dropForeign('custom_module_admins_ibfk_2');
		});
	}

}
