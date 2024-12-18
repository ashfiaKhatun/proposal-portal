<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->isSuperAdmin) {
            $supervisors = User::with('department')
                ->where('role', 'supervisor')
                ->where('isAdmin', true)
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->get();

            $supervisorCount = User::with('department')
                ->where('role', 'supervisor')
                ->where('isAdmin', true)
                ->where('status', 'approved')
                ->count();
            return view('template.home.users.admins.index', compact('supervisors', 'supervisorCount'));
        } else {
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }
}
