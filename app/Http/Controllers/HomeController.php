<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('template.home.index'); // Ensure you have a view named 'home'
    }
}
