<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	protected $fillable = ['userID', 'studentID', 'labID', 'description'];

	public function laboratory()
	{
		return $this->belongsTo('App\Laboratory', 'labID');
	}

	public function user()
	{
		return $this->hasOne('App\User', 'userID');
	}

	public function student()
	{
		return $this->belongsTo('App\Student','studentID');
	}
}
