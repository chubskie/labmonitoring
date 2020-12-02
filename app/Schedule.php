<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // protected $primaryKey = 'scheduleID';
    protected $fillable = ['start', 'end', 'reccuring', 'reccuringEnd', 'description', 'professor', 'course', 'category', 'isReadOnly'];
 
    public function laboratory()
    {
        return $this->belongsTo('App\Laboratory','labID');
    }
}
