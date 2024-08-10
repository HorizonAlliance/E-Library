<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $loggedUser = Auth::user()->id;
        $users = User::whereNot('id', $loggedUser)->latest()->paginate(10);
        return view('admin.users.users', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.add_users');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|string',
            'avatar' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
        ]);

        try {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatar->storeAs('public/avatars', $avatar->hashName());

                User::create([
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'address' => $validatedData['address'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'role' => $validatedData['role'],
                    'avatar' => $avatar->hashName(),
                ]);
            } else {
                User::create([
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'address' => $validatedData['address'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'role' => $validatedData['role'],
                ]);
            }

            return redirect()->back()->with('success', 'Create account successful');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('User creation failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'User creation failed: ' . $e->getMessage());
        }
    }


    public function edit(string $id): View
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit_users', compact('user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'avatar' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatars', $avatar->hashName());

            Storage::delete('public/avatars/' . $avatar->hashName());

            $user->update([
                'username' => $request->username,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'role' => $request->role,
                'avatar' => $avatar->hashName(),
            ]);
        } else {
            $user->update([
                'username' => $request->username,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        Storage::delete('public/avatars/' . $user->avatar);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'delete user success');
    }
}
