<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SupervisorController extends Controller
{
    public function index()
    {
        $supervisors = User::where('role', 'supervisor')
            ->where('dept_id', auth()->user()->dept_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('template.home.users.supervisors.index', compact('supervisors'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('template.home.users.supervisors.create', compact('departments'));
    }

    public function createSupervisor()
    {
        $departments = Department::all();
        return view('template.auth.page-supervisor-register', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'role' => 'required|string',
            // 'isAdmin' => 'boolean',
            // 'isSuperAdmin' => 'boolean',
            'dept_id' => 'nullable|exists:departments,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'official_id' => $request->teacher_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'designation' => $request->designation,
            'role' => 'supervisor',
            'isAdmin' => $request->isAdmin ?? false,
            'isSuperAdmin' => $request->isSuperAdmin ?? false,
            'dept_id' => auth()->user()->dept_id,
        ]);
        return redirect()->route('supervisors.index');
    }

    public function storeSupervisors(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'role' => 'required|string',
            // 'isAdmin' => 'boolean',
            // 'isSuperAdmin' => 'boolean',
            'dept_id' => 'nullable|exists:departments,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'official_id' => $request->teacher_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'designation' => $request->designation,
            'role' => 'supervisor',
            'isAdmin' => $request->isAdmin ?? false,
            'isSuperAdmin' => $request->isSuperAdmin ?? false,
            'dept_id' => $request->dept_id,
        ]);
        return redirect()->route('login');
    }

    public function edit($id)
    {
        $supervisor = User::findOrFail($id);
        $departments = Department::all();
        return view('template.home.users.supervisors.edit', compact('supervisor', 'departments'));
    }

    public function update(Request $request, $id)
    {

        $supervisor = User::findOrFail($id);
        
        $supervisor->update([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'role' => 'supervisor',
            'isAdmin' => $request->isAdmin ?? false,
            'isSuperAdmin' => $request->isSuperAdmin ?? false,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $supervisor = User::findOrFail($id);
        $supervisor->delete();

        return redirect()->back();
    }
}
