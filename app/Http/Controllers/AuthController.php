<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(): View
    {
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
        ]);

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatars', $avatar->hashName());

            User::create([
                'username' => $request->username,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => $request->avatar,
            ]);
            return redirect()->route('login')->with('success', 'Register Success');
        } else {
            User::create([
                'username' => $request->username,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('login')->with('success', 'Register Success');
        }
    }

    public function login_action(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $role = Auth::user()->role;
            switch ($role) {
                case 'admin':
                case 'librarian':
                    return redirect()->route('dashboard');
                case 'reader':
                    return redirect()->route('homepage');
                default:
                    return redirect()->back()->with('error', 'Invalid role assigned');
            }
        }
        return redirect()->route('login')->with('error', 'login failed');
    }

    // public function login_action(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required','min:8']
    //     ]);

    //     $user = User::where('email',$request->email)->first();

    //     if($user && Hash::check($request->password,$user->password)){
    //         Auth::login($user);
    //         $role = $user->role;
    //         switch ($role) {
    //             case 'admin':
    //             case 'librarian':
    //                 return redirect()->route('dashboard')->with('success','login successfully');
    //             case 'reader' :
    //                 return redirect()->route('homepage')->with('success','login successfully');
    //             default:
    //                 return redirect()->back()->with('error','login failed');
    //         }
    //     }
    //     return redirect()->back()->with('error','login failed');
    // }

    public function logout(Request $request): RedirectResponse
    {
        Log::info('Logout method called');
        try {
            //code...
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->flush();
            $request->session()->regenerateToken();

            Log::info('User logged out');
            return redirect()->route('homepage')->with('success', 'Logout successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }
}