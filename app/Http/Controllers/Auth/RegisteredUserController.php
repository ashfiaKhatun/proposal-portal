<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $departments = Department::all();
        return view('template.auth.page-register', compact('departments'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string',
            'isAdmin' => 'boolean',
            'isSuperAdmin' => 'boolean',
            'dept_id' => 'nullable|exists:departments,id',
            // 'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // // Handle file upload
        // $profilePicturePath = null;
        // if ($request->hasFile('profile_picture')) {
        //     $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        // }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'isAdmin' => $request->isAdmin ?? false,
            'isSuperAdmin' => $request->isSuperAdmin ?? false,
            'dept_id' => $request->dept_id,
            // 'profile_picture' => $profilePicturePath,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
