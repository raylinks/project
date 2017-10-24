<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\Mail\WelcomeBack;
use App\User;
use Auth;
use Mail;

use Illuminate\Http\Request;

class SignupController extends Controller
{
   public function getReg()
   {
   	return view('accounts.sign-up');
   }

   public function postReg(RegistrationForm $request)
   {
        $user =  User::create([
            'full_name' => $request->input('full_name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone_num' => $request->input('phone_num'),
            'is_user' => 1,
            ]);

        # Auth::login($user);
         Mail::to($user)->send(new WelcomeBack($user));



   		session()->flash('success', 'Registration is Successful');
   		return redirect()->back();
   }

  
}
