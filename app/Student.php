<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['fullName', 'studentNumber'];
    protected $primaryKey = 'studentID';
    public function log()
    {
        return $this->hasMany('App\Log','studentID');
    }
}
