<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
	protected $fillable = ['labName', 'color'];

	public function schedule()
	{
		return $this->hasMany('App\Schedule','labID');
	}
	public function log()
    {
        return $this->hasMany('App\Log','labID');
    }
}
