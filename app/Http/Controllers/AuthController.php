<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    //
    public function login()
    {
        // show login view
        // if already sign in, redirect to dashboard
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        // validate request first
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // set credentials
        $credentials = $request->only('email', 'password');
        // if successfull, redirect to dashboard
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }
        // if fail auth
        return redirect('login')->withSuccess('Login details are not valid');
    }


    public function register()
    {
        // if already sign in, redirect to dashboard
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('auth.register');
    }

    public function customRegister(Request $request)
    {
        // validate request data first
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // get all data regarding user input and create user
        // using this controller function create
        $data = $request->all();
        $check = $this->create($data);


        // set credentials
        $credentials = $request->only('email', 'password');
        // if successfull, redirect to dashboard
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        // redirect to login page if somehow fail login after registering
        return redirect('login');
    }

    public function create(array $data)
    {
        return User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );
    }

    public function dashboard()
    {
        // if pass auth, return dashboard view
        // if not redirect to login with message
        if (Auth::check()) {
            $user = Auth::user();
            return view('dashboard')->with('user',$user);
        }
        return redirect("login")->withSuccess('You are not given access');
    }

    public function signOut()
    {
        // sign out
        // Session::flush();
        FacadesSession::flush();
        Auth::logout();

        return Redirect('login');
    }
}
