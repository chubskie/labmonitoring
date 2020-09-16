<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'logID';
    protected $fillable = ['userID', 'description', 'timestamp'];
    
    public function student()
    {
        return $this->hasOne('App\Student','studentID');
    }
}
