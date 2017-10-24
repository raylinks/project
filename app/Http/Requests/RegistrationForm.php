<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'full_name' => 'required|max:255',
        'email' => 'required|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'phone_num' => 'required|min:11',

        ];
    }

    public function persist()
    {
         $user =  User::create([
            'full_name' => $request->input('full_name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone_num' => $request->input('phone_num'),
            'is_user' => 1,
            ]);

         Auth::login($user);
         Mail::to($user)->send(new WelcomeBack($user));

    }
}
