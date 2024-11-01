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
        $supervisors = User::where('role', 'supervisor')
            ->where('isAdmin', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('template.home.users.admins.index', compact('supervisors'));
    }
    
}
