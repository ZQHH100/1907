<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function test(){
    	
    }
    public function login(){
    	return view('login');
    }
}
