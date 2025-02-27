<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Movie;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, false)) {
            $request->session()->regenerate();

            return redirect()->route('loggedin')->withSuccess('Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais apresentadas não batem com nossos registros.',
        ])->onlyInput('email');
    }


    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('home')->withSuccess('Logout realizado com sucesso!');
        }else{
            return redirect()->route('home');
        }
    }

}
