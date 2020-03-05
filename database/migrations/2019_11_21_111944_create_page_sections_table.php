<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePageSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page_sections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('page_id')->unsigned();
			$table->integer('section_id');
			$table->integer('position')->nullable();
			$table->string('section', 128)->default('');
			$table->text('data', 65535);
			$table->integer('render')->nullable()->default(1);
			$table->string('class', 128)->nullable()->default(' ');
			$table->string('base_class', 128)->nullable()->default('section-85');
			$table->integer('active')->default(1);
			$table->timestamps();
			$table->integer('in_menu')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('page_sections');
	}

}
