<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('template.home.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create([
            'name' => $request->name,
        ]);

        return redirect()->route('departments.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
        ]);

        return redirect()->route('departments.index');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index');
    }

    public function showSupervisors($id)
    {
        $department = Department::find($id);
        $supervisors = User::where('dept_id', $id)->where('role', 'supervisor')->get();

        return view('template.home.departments.supervisors', compact('department', 'supervisors'));
    }

    public function showStudents($id)
    {
        $department = Department::find($id);
        $students = User::where('dept_id', $id)->where('role', 'student')->get();

        return view('template.home.departments.students', compact('department', 'students'));
    }
}
