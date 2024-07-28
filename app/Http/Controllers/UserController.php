<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * menampilkan seluruh data User
     *
     * @return View Menampilkan Data user
     */
    public function index(): View
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    /**
     * menampilkan form untuk menambahkan daata user
     *
     * @return View Menampilakn Form User
     */
    public function create(): View
    {
        $level = Level::all();
        return view('admin.user.create', compact('level'));
    }

    /**
     * Menyimpan data User ke dalam database
     *
     * @param Request $request Request data
     * @return RedirectResponse Redirect ke halaman data user
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'nama_admin' => 'required',
            'level' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->username = request('username');
        $user->password = request('password');
        $user->nama_admin = request('nama_admin');
        $user->id_level = request('level');
        $user->save();

        return redirect()->route('admin.user.index');
    }

    /**
     * Menampilkan form untuk edit user
     *
     * @param User $user Model User beserta id-nya
     * @return View menampilkan form edit user
     */
    public function edit(User $user)
    {
        $level = Level::all();
        return view('admin.user.edit', compact('user', 'level'));
    }

    /**
     * Mengupdate data User untuk diubah di database
     *
     * @param Request $request Request data
     * @param User $user Model User beserts id-nya
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'nama_admin' => 'required',
            'level' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user->update([
            'username' => request('username'),
            'password' => request('password'),
            'nama_admin' => request('nama_admin'),
            'id_level' => request('level'),
        ]);
        return redirect()->route('admin.user.index');
    }

    /**
     * Menghapus data user yang di pilih dari database
     *
     * @param User $user Model User beserta id-nya
     * @return RedirectResponse Redirect ke halaman data user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
