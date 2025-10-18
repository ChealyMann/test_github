<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Role;
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
        $roles = Role::all();
        $languages = Language::all();
        return view('auth.register', compact('roles', 'languages'));

    }

    function register(Request $request){

        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'language_id' => 'required|exists:languages,id',
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
            'role_id' => $request->role_id,
            'language_id' => $request->language_id,
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
