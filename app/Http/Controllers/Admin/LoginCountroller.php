<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCountroller extends Controller
{
    // public function loginDo(){
    // 	$post=request()->except('_token');

    	// $user = \DB::table('admins')->where($post)->first();
    	
    	// if($user){
    	// 	session(['user'=>$user]);
    	// 	request()->session()->save();
    		
    	// 	return redirect('/article');
    	// }
   // }
    public function dologin(){
        $post=request()->except('_token');
       
        if(Auth::attempt($post)){
       
 // 认证通过...
    return redirect()->intended('brand');
        
        }
    }
}
