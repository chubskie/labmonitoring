<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey = 'scheduleID';
    protected $fillable = ['timeStart', 'timeEnd', 'reccuring', 'reccuringEnd', 'color', 'description', 'labID', 'userID'];

    public function laboratory()
    {
        return $this->hasOne('App\Laboratory','laboratoryID');
    }

    public function student()
    {
        return $this->hasOne('App\Student','studentID');
    }
}
