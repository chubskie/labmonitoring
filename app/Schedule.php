<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // protected $primaryKey = 'scheduleID';
    protected $fillable = ['timeStart', 'timeEnd', 'reccuring', 'reccuringEnd', 'color', 'description', 'labID'];

    public function laboratory()
    {
        return $this->belongsTo('App\Laboratory','labID');
    }
}
