<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['fullName', 'studentNumber'];

    public function log()
    {
        return $this->belongsTo('App\Log','logID');
    }
}
