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
        if(auth()->user()->isSuperAdmin || auth()->user()->isAdmin){
            $supervisors = User::where('role', 'supervisor')
                ->where('dept_id', auth()->user()->dept_id)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('template.home.users.supervisors.index', compact('supervisors'));
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        if(auth()->user()->isSuperAdmin || auth()->user()->isAdmin){
            $departments = Department::all();
            return view('template.home.users.supervisors.create', compact('departments'));
        } else {
            return redirect('/');
        }
    }

    public function createSupervisor()
    {
        $departments = Department::all();
        return view('template.auth.page-supervisor-register', compact('departments'));
    }

    public function store(Request $request)
    {
        if(auth()->user()->isSuperAdmin || auth()->user()->isAdmin){
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
        } else {
            return redirect('/');
        }
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
        if(auth()->user()->isSuperAdmin || auth()->user()->isAdmin){
            $supervisor = User::findOrFail($id);
            $departments = Department::all();
            return view('template.home.users.supervisors.edit', compact('supervisor', 'departments'));
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->isSuperAdmin || auth()->user()->isAdmin){
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
        } else {
            return redirect('/');
        }
    }

    public function destroy($id)
    {
        if(auth()->user()->isSuperAdmin || auth()->user()->isAdmin){
            $supervisor = User::findOrFail($id);
            $supervisor->delete();
    
            return redirect()->back();
        } else {
            return redirect('/');
        }
    }
}
