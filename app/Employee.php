<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Position;

class Employee extends Model
{

     protected $fillable = [
        'name',
        'start_work',
        'salary',
        'position_id',
        'pid'
    ];

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    

}
