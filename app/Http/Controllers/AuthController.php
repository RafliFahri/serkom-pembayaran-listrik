<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthController extends Controller
{
    function index(): View
    {
        return view('customer.login');
    }

    /**
     * Melakukan Login untuk Customer/Pelanggan
     *
     * @author Rafli Fahri
     * @version 1
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @note  Login Pelanggan untuk masuk ke tampilan pelanggan
     * @throw Validation Error
     */
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $pelanggan = Pelanggan::where('username', $request->username)->where('password', $request->password)->first();
        if ($pelanggan && $pelanggan->password === $request->password) {
            // Login manual tanpa hashing password
            Auth::guard('customer')->login($pelanggan);
            $request->session()->regenerate();
            // Redirect ke halaman yang dituju
            return redirect()->intended('/penggunaan');
        }
        return back()->withInput()->withErrors(['username' => ' Username atau Password salah!']);
    }
    function indexAdmin(): View
    {
        return view('admin.login');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @note Login untuk admin
     */
    function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::where('username', $request->username)->where('password', $request->password)->first();
        if ($user && $user->password === $request->password) {
            // Login manual tanpa hashing password
            Auth::guard('admin')->login($user);
            $request->session()->regenerate();
            // Redirect ke halaman yang dituju
            return redirect()->intended('/admin/dashboard');
        }
        return back()->withErrors(['username' => 'Email atau password salah.']);
    }

    function logout(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
//        return redirect('/login');
        return redirect()->route('customer.login');
    }
}
