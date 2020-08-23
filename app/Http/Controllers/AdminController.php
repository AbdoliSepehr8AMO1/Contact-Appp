<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    // construct is a securtiy method that checks if the user is auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // if the user the role of admin the redirect to admin.dashbord if not redirect to home
    public function index()
    {
        {
            if (request()->user()->hasRole('admin')) {
                return view('admin.dashboard');
            }
            if (request()->user()->hasRole('user')) {
                return redirect('/home');
            }
        }
    }
}