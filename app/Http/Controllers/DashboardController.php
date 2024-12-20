<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function customer()
    {
        return view('dashboard.customers.index');
    }
    public function supplier()
    {
        return view('dashboard.suppliers.index');
    }
    public function user()
    {
        return view('dashboard.users.index');
    }
}
