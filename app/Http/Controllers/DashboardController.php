<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller;


class DashboardController extends Controller
{
    function __construct()
    {

        $this->middleware(['permission:view-dashboard']);
    }

    public function index()
    {

        return view('dashboard');
    }
}
