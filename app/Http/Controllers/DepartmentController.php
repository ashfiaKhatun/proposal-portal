<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Proposal;
use App\Models\User;
use App\Notifications\AdminAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DepartmentController extends Controller
{
    public function index()
    {
        if (auth()->user()->isSuperAdmin) {
            $departments = Department::all();
            $departmentCount = Department::all()->count();

            return view('template.home.departments.index', compact('departments', 'departmentCount'));
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }

    public function createAdmin($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::findOrFail($id);
            return view('template.home.departments.create_admin', compact('department'));
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }

    public function storeAdmin(Request $request, $id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::findOrFail($id);
    
            // Create the admin user
            $user = User::create([
                'name' => $request->name,
                'official_id' => $request->teacher_id,
                'teacher_initial' => $request->teacher_initial,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'designation' => $request->designation,
                'role' => 'supervisor',
                'status' => 'approved',
                'isAdmin' => true,
                'isSuperAdmin' => $request->isSuperAdmin ?? false,
                'dept_id' => $id,
            ]);
    
            // Send the notification to the new admin
            $user->notify(new AdminAssignedNotification($department->name, $user->name));
    
            return redirect()->route('departments.supervisors', ['id' => $id])->with('success', 'Admin created successfully!');
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
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

            return redirect()->route('departments.index')->with('success', 'Department added successfully!');
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
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
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::findOrFail($id);
            $department->delete();

            return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }

    public function showSupervisors($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::find($id);
            $supervisors = User::where('dept_id', $id)
                ->where('role', 'supervisor')
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->get();

            $supervisorCount = User::where('dept_id', $id)
                ->where('role', 'supervisor')
                ->where('status', 'approved')
                ->count();

            return view('template.home.departments.supervisors', compact('department', 'supervisors', 'supervisorCount'));
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }

    public function showStudents($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::find($id);
            $students = User::where('dept_id', $id)
                ->where('role', 'student')
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->get();

            $studentCount = User::where('dept_id', $id)
                ->where('role', 'student')
                ->where('status', 'approved')
                ->count();

            $batches = User::distinct()
                ->where('dept_id', $id)
                ->pluck('batch');

            return view('template.home.departments.students', compact('department', 'students', 'studentCount', 'batches'));
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }

    public function showProposals($id)
    {
        if (auth()->user()->isSuperAdmin) {
            $department = Department::find($id);

            $proposals = Proposal::where('dept_id', $id)
                ->with('student', 'assignedTeacher')
                ->orderBy('created_at', 'desc')
                ->get();

            $proposalCount = Proposal::where('dept_id', $id)
                ->with('student', 'assignedTeacher')
                ->count();

            $supervisors = User::where('role', 'supervisor')
                ->where('dept_id', $department)
                ->get();

            $batches = User::distinct()
                ->where('dept_id', $id)
                ->pluck('batch');

            $type = '';
            $showExtraColumns = false;

            return view('template.home.proposals.index', compact('proposals', 'supervisors', 'type', 'showExtraColumns', 'proposalCount', 'batches'));  // Return the view with proposals
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }
}
