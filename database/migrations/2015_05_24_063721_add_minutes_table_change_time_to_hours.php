<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMinutesTableChangeTimeToHours extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employee_hours', function(Blueprint $table)
		{
			$table->integer('minutes')->after('hours');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employee_hours', function(Blueprint $table)
		{
			$table->dropColumn('minutes');
		});
	}

}
