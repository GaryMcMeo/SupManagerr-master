<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        // $user = auth()->user(); // Correctly retrieve the logged-in user
        // return view('profile.edit', compact('users'));
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        // ]);

        // $request->users()->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        // ]);

        // return back()->with('status', 'Profile berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'Password berhasil diperbarui');
    }
}