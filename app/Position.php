<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Employee;

class Position extends Model
{

    protected $fillable = [
        'position'
    ];

    public function employee()
    {
        return $this->hasMany('App\Employee');
    }
}
