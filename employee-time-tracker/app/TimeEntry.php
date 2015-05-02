<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model {

	//Use the time_entries table
	protected $table = 'time_entries';

	//An array of fields we can fill in the time_entries table
	protected $fillable = ['user_id', 'start_time', 'end_time', 'comment'];

	protected $hidden = ['user_id'];

	// Carbon date accessors
	protected $dates = ['start_time', 'end_time'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function setStartTimeAttributes($date)
	{
		$this->attributes['start_time'] = Carbon::parse($date);
	}

	public function setEndTimeAttributes($date)
	{
		$this->attributes['end_time'] = Carbon::parse($date);
	}

	public function setDateStampAttributes($date)
	{
		$this->attributes['start_time'] = Carbon::parse($date);
	}

}
