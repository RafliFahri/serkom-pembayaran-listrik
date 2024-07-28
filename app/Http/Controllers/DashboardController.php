<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     * Menampilkan Halaman Dashboard Pelanggan
     */
    function index()
    {
        return view('customer.dashboard');
    }

    function indexAdmin()
    {
        return view('admin.index');
    }
}
