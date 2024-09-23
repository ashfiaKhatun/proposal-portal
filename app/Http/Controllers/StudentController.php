<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->where('dept_id', auth()->user()->dept_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('template.home.users.students.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('template.home.users.students.create', compact('departments'));
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
            'official_id' => $request->student_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'isAdmin' => $request->isAdmin ?? false,
            'isSuperAdmin' => $request->isSuperAdmin ?? false,
            'dept_id' => auth()->user()->dept_id,
        ]);
        return redirect()->route('students.index');
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        $departments = Department::all();
        return view('template.home.users.students.edit', compact('student', 'departments'));
    }

    public function update(Request $request, $id)
    {

        $student = User::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'official_id' => $request->student_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'isAdmin' => $request->isAdmin ?? false,
            'isSuperAdmin' => $request->isSuperAdmin ?? false,
            'dept_id' => $request->dept_id,
        ]);

        return redirect()->route('students.index');
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index');
    }
}
