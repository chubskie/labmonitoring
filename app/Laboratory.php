<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
	protected $fillable = ['labName'];

	public function schedule()
	{
		return $this->hasMany('App\Schedule','labID');
	}
}
