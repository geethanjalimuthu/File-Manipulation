<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getlogin(){
    	return view('auth.login');
    }
    public function postlogin(Request $request){
    	$var = $this->validate($request,['email' =>'required|email','password' => 'required|min:8']);
        	if(auth()->attempt(['email'=>$request->input('email'),
    		'password' => $request->input('password')])){

                 return redirect('profile')->with(['message' => 'You have successfully logged in']);
    		
        }
        else{
            
           return back()->withInput()->with(['message' => 'Invalid username or password']);
    	}
    }
    
    public function logout(){

    	auth()->logout();
    	return redirect()->to(url('login'));
    }
}
