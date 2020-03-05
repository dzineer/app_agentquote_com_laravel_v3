<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelescopeEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telescope_entries', function(Blueprint $table)
		{
			$table->bigInteger('sequence', true)->unsigned();
			$table->char('uuid', 36)->unique();
			$table->char('batch_id', 36)->index();
			$table->string('family_hash', 191)->nullable()->index();
			$table->boolean('should_display_on_index')->default(1);
			$table->string('type', 20);
			$table->text('content');
			$table->dateTime('created_at')->nullable();
			$table->index(['type','should_display_on_index']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telescope_entries');
	}

}
