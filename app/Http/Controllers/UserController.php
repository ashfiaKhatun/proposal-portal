<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $supervisors = User::where('role', 'teacher');
        return view('template.home.users.supervisors.index', compact('supervisors'));
    }
}
