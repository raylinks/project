<?php

namespace App\Http\Controllers;
use App\User;
use Auth;

use Illuminate\Http\Request;

class SigninController extends Controller
{

   
# if you are an authenticated user, you wont be able to accesa any of these...getLog and postLog respectively
    public function __construct()
    {
        $this->middleware('guest');
    }

	public function getLog()
	{
		return view('accounts.sign-in');
	}

    public function PostLog(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required',
    		'password' => 'required',
			]);
          if(Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'is_user' => 1,
                ], $request->has('remember')))
            {
                return redirect('/');
            }

           

    	session()->flash('danger', 'Authentication failed! Try again');
    	return redirect()->back();
    }
}
