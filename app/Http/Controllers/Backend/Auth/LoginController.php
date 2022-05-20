<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function __construct()
	{
	}
	// show login form and check login admin guard  auth
    public function showLoginForm()
    {
		if(Auth::guard('admin')->check())
		{
			return redirect('dashboard');
		}
    	return view('backend.auth.login');
    }
	//  login submit
    public function login(Request $request)
    {
    	$request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if(Auth::guard('admin')->attempt(['email'=> $request->name, 'password' => $request->password])) // email login
        {
        	 return redirect()->intended('dashboard');
        }
        else
        {
        	if(Auth::guard('admin')->attempt(['username'=> $request->name, 'password' => $request->password])) //username login 
        	{
        		return redirect()->intended('dashboard');
        	}
        	else
        	{
        		return back();
        	}
        	return back();
        }
    }
    // admin logout
    public function adminLogout()
    {
    	Auth::guard('admin')->logout();
    	return redirect(route('dashboard.login'));
    }
}
