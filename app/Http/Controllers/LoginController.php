<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    public function create()
    {
        return view('auth.login'); 
    }
    public function store(Request $request)
    {
      
       $attributes = $request->validate([
        'email' => ['required','email'],
        'password' => ['required']
       ]);      
  

        if (Auth::attempt($attributes))
        {
            //dd($attributes);
            return redirect(RouteServiceProvider::HOME);
            throw ValidationException::withMessages([
                'email' => 'Your email was wrong !'
            ]);
        }
    }
}
