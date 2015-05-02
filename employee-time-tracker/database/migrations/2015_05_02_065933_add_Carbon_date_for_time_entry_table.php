<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCarbonDateForTimeEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('time_entries', function(Blueprint $table)
		{
			$table->dateTime('date_stamp');
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
			$table->dropColumn('date_stamp');
		});
	}

}
