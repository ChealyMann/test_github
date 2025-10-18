<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function loginForm(){

        return view('auth.login');

    }

    public function login(Request $request){
        $user_credentials = $request->only('email', 'password');
        if (Auth::attempt($user_credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors(['error','Email or password invalid']);
    }

    function registerForm(){
        return view('auth.register');

    }

    function register(Request $request){

        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
    }

}
