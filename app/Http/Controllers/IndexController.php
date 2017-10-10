<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    /**
     * Show index page
     * @return object main view
     */
    public function index()
    {
        return view('index');
    }
}
