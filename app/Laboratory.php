<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $primaryKey = 'labID';
    protected $fillable = ['labName', 'labStatus'];

    public function schedule()
    {
        return $this->hasMany('App\Schedule','scheduleID');
    }
}
