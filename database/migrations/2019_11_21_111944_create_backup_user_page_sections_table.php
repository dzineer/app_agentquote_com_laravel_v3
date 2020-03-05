<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBackupUserPageSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('backup_user_page_sections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('page_id')->unsigned();
			$table->integer('section_id');
			$table->integer('position');
			$table->string('section', 128)->default('');
			$table->text('data', 65535);
			$table->integer('render')->default(1);
			$table->string('class', 128)->default(' ');
			$table->string('base_class', 128)->default('section-85');
			$table->integer('active')->default(1);
			$table->integer('version');
			$table->timestamps();
			$table->integer('in_menu')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('backup_user_page_sections');
	}

}
