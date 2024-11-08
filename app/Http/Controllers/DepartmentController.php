<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DepartmentController extends Controller
{
    public function index()
    {
        if (auth()->user()->isSuperAdmin) {
            $departments = Department::all();
            return view('template.home.departments.index', compact('departments'));
        } else {
            return redirect('/');
        }
    }

    public function createAdmin($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::findOrFail($id);
            return view('template.home.departments.create_admin', compact('department'));
        } else {
            return redirect('/');
        }
    }

    public function storeAdmin(Request $request, $id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::findOrFail($id);

            $user = User::create([
                'name' => $request->name,
                'official_id' => $request->teacher_id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'designation' => $request->designation,
                'role' => 'supervisor',
                'status' => 'approved',
                'isAdmin' => true,
                'isSuperAdmin' => $request->isSuperAdmin ?? false,
                'dept_id' => $id,
            ]);
            return redirect()->route('departments.supervisors', ['id' => $id]);
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->isSuperAdmin) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            Department::create([
                'name' => $request->name,
            ]);

            return redirect()->route('departments.index');
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->isSuperAdmin) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $department = Department::findOrFail($id);
            $department->update([
                'name' => $request->name,
            ]);

            return redirect()->route('departments.index');
        } else {
            return redirect('/');
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::findOrFail($id);
            $department->delete();

            return redirect()->route('departments.index');
        } else {
            return redirect('/');
        }
    }

    public function showSupervisors($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::find($id);
            $supervisors = User::where('dept_id', $id)
                ->where('role', 'supervisor')
                ->where('status', 'approved')
                ->get();

            return view('template.home.departments.supervisors', compact('department', 'supervisors'));
        } else {
            return redirect('/');
        }
    }

    public function showStudents($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::find($id);
            $students = User::where('dept_id', $id)
                ->where('role', 'student')
                ->where('status', 'approved')
                ->get();

            return view('template.home.departments.students', compact('department', 'students'));
        } else {
            return redirect('/');
        }
    }

    public function showProposals($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::find($id);

            $proposals = Proposal::where('dept_id', $id)
                ->with('student', 'assignedTeacher')
                ->get();

            $supervisors = User::where('role', 'supervisor')
                ->where('dept_id', $department)
                ->get();

            $type = '';
            $showExtraColumns = false;

            return view('template.home.proposals.index', compact('proposals', 'supervisors', 'type', 'showExtraColumns'));  // Return the view with proposals
        } else {
            return redirect('/');
        }
    }
}
