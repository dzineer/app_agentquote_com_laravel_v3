<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custom_modules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->default('')->index('data');
			$table->string('module_name', 191);
			$table->string('module_image', 191);
			$table->string('module_display_image', 191);
			$table->string('description', 191)->nullable();
			$table->integer('module_type_id')->unsigned()->default(1)->index('module_type_id');
			$table->integer('featured')->unsigned()->nullable()->default(1);
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->text('data', 65535)->nullable();
			$table->integer('supports_admin')->nullable()->default(1);
			$table->integer('supports_user')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('custom_modules');
	}

}
