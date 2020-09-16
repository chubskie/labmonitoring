<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'studentID';
    protected $fillable = ['type', 'fullName', 'studentNumber'];

    public function schedule()
    {
        return $this->belongsTo('App\Schedule','scheduleID');
    }

    public function log()
    {
        return $this->belongsTo('App\Log','logID');
    }
}
