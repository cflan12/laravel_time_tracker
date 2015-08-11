<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEndTimeOnTimeEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('time_entries', function(Blueprint $table)
		{
			$table->dropColumn('end_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('time_entries', function(Blueprint $table)
		{
			$table->datetTime('end_time');
		});
	}

}
