<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() : View    {
        return view('auth.login');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function register_action(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            // 'role' => '',
            // 'avatar' => '',
        ]);

        if($request->file('avatar')){
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatars',$avatar->hashName());

            User::create([
                'username' => $request->username,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'role' => ,
                'avatar' => $request->avatar,
            ]);
            return redirect()->route('login')->with('success','anjing iso cok');
        } else {
            User::create([
                'username' => $request->username,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'role' => ,
            ]);
            return redirect()->route('login')->with('success','anjing iso cok');
        }
        return redirect()->route('login')->with('success','anjing iso cok');
    }

    public function login_action(Request $request) : RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            $role = Auth::user()->role;
            switch ($role) {
                case 'admin':
                    return redirect()->route('dashboard');
                case 'librarian':
                    return redirect()->route('dashboard');
                case 'reader':
                    return redirect()->route('home');
                default:
                    return redirect()->back()->with('error','role  invalid');
            }
        }
        return redirect()->route('login')->with('error','login failed');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success','logout successfully');
    }
}
