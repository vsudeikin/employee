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

    /**
     * Returns parent employees
     * @return [type] [description]
     */
    public function pid()
    {
        return $this->belongsTo($this, 'id');
    }

    /**
     * Returns child employees
     * @return [type] [description]
     */
    public function cid()
    {
        return $this->hasMany($this, 'pid');
    }

    public function rootEmployer(){
        return $this->where('id', 1)->with('cid')->get();
    }

}
