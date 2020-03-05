<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelescopeEntriesTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telescope_entries_tags', function(Blueprint $table)
		{
			$table->char('entry_uuid', 36);
			$table->string('tag', 191)->index();
			$table->index(['entry_uuid','tag']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telescope_entries_tags');
	}

}
