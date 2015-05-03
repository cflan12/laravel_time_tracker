<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $table = 'comments';

	protected $fillable = ['comment'];

	public function user()
	{
		$this->belongsTo('App\User');
	}


}
