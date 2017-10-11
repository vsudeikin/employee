<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Employee;

class IndexController extends Controller
{
    
    /**
     * Show index page
     * @return object main view
     */
    public function index()
    {

        dump(Position::find($i)->employee->toArray());
   }

}