<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Apresenta a página Dashbaord
     public function index()
    {
        return view('dashboard.dashboard');
    }
}
