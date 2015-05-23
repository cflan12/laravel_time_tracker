<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateToEmployeeHours extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employee_hours', function(Blueprint $table)
		{
			$table->date('date')->after('hours');
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
			$table->dropColumn('date');
		});
	}

}
