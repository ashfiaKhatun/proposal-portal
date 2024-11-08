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
        if(auth()->user()->isAdmin){
            $students = User::where('role', 'student')
                ->where('dept_id', auth()->user()->dept_id)
                ->orderBy('created_at', 'desc')
                ->get();
    
            return view('template.home.users.students.index', compact('students'));
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        if(auth()->user()->isAdmin){
            $departments = Department::all();
            return view('template.home.users.students.create', compact('departments'));
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->isAdmin){
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
                'batch' => $request->batch,
                'credit_finished' => $request->credit_finished,
                'cgpa' => $request->cgpa,
                'role' => 'student',
                'status' => 'approved',
                'isAdmin' => $request->isAdmin ?? false,
                'isSuperAdmin' => $request->isSuperAdmin ?? false,
                'dept_id' => auth()->user()->dept_id,
            ]);
            return redirect()->route('students.index');
        } else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        if(auth()->user()->isAdmin){
            $student = User::findOrFail($id);
            $departments = Department::all();
            return view('template.home.users.students.edit', compact('student', 'departments'));
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->isAdmin){
            $student = User::findOrFail($id);
            
            $student->update([
                'name' => $request->name,
                'official_id' => $request->student_id,
                'email' => $request->email,
                'batch' => $request->batch,
                'credit_finished' => $request->credit_finished,
                'cgpa' => $request->cgpa,
                'dept_id' => $request->dept_id,
            ]);
    
            return redirect()->back();
        } else {
            return redirect('/');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $supervisor = User::findOrFail($id);

        if (auth()->user()->isAdmin && auth()->user()->dept_id === $supervisor->dept_id) {
            $request->validate([
                'status' => 'required|in:pending,approved,rejected',
            ]);

            $supervisor->update(['status' => $request->status]);

            return redirect()->back();
        } else {
            return redirect('/');
        }
    }

    public function destroy($id)
    {
        if(auth()->user()->isAdmin){
            $student = User::findOrFail($id);
            $student->delete();
    
            return redirect()->back();
        } else {
            return redirect('/');
        }
    }
}
