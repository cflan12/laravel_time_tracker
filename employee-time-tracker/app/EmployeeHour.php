<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmployeeHour extends Model {

	protected $table = 'employee_hours';

	protected $fillable = ['user_id', 'hours'];

	// Carbon date accessors
	//protected $dates = ['hours'];


}