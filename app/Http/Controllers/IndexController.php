<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        if(!env('APP_INSTALLED',false)){
            return redirect()->route('installer');
        }
    	return view('index');
    }
}
