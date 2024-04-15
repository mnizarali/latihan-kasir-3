<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDO;

class UserController extends Controller
{
    public function login() {
        return view("auth.login");
    }
    
    public function auth(Request $request) {
        $request->validate([
            "email"    => 'required|email',
            "password" => 'required'
        ]);

        $user = User::where('email', $request->email)->first();  

        if ($user && Hash::check($request->password, $user->password)) {
            $user->last_login = now()->format("Y-m-d H:i:s");
            $user->save();

            Auth::login($user);
            return redirect('/dashboard');
        }

        return back()->with('fail', 'Username or Password Invalid');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
