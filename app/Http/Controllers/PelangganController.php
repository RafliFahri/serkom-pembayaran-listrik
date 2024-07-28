<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PelangganController extends Controller
{
    /**
     * Menampilkan Seluruh data pelanggan dari database
     *
     * @return View Meampilkan data pelanggan
     */
    public function index(): View
    {
        $pelanggan = Pelanggan::all();
        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Menampilkan form tambah pelanggan
     *
     * @return View Menampilkan Form Tambah
     */
    public function create(): View
    {
        $tarif = Tarif::all();
        return view('admin.pelanggan.create', compact('tarif'));
    }

    /**
     * Memasukkan data Pelanggan kedalam database
     *
     * @param Request $request Request data
     * @return RedirectResponse Redirect ke halaman Data Pelanggan
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'nomor_kwh' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'daya' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $pelanggan = new Pelanggan();
        $pelanggan->username = request('username');
        $pelanggan->password = request('password');
        $pelanggan->nomor_kwh = request('nomor_kwh');
        $pelanggan->nama_pelanggan = request('nama_pelanggan');
        $pelanggan->alamat = request('alamat');
        $pelanggan->id_tarif = request('daya');
        $pelanggan->save();

        return redirect()->route('admin.pelanggan.index');
    }
    /**
     * Menampilkan form untuk mengedit data pelanggan secara spesifik
     *
     * @param Pelanggan $pelanggan Memelukan ID pelanggan
     * @return View Menampilkan Form
     */
    public function edit(Pelanggan $pelanggan): View
    {
        $tarif = Tarif::all();
        return view('admin.pelanggan.edit', compact('pelanggan', 'tarif'));
    }

    /**
     * Mengupdate data pelanggn yang sudah ada secara spesifik dan disimpan ke dalam penyimpanan (Admin/User)
     *
     * @param Request $request Request data pelanggan yang akan diupdate
     * @param Pelanggan $pelanggan Berisi data pelanggan yang akan di update
     * @return RedirectResponse Redirect ke halaman Data Pelanggan jika berhasil, atau kembali ke form dengan error message jika gagal
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'nomor_kwh' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'daya' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $pelanggan->username = request('username');
        $pelanggan->password = request('password');
        $pelanggan->nomor_kwh = request('nomor_kwh');
        $pelanggan->nama_pelanggan = request('nama_pelanggan');
        $pelanggan->alamat = request('alamat');
        $pelanggan->id_tarif = request('daya');
        $pelanggan->update();
        return redirect()->route('admin.pelanggan.index');
    }

    /**
     * Menghapus data pelanggan dari database (Admin/User)
     *
     * @param Pelanggan $pelanggan Model Pelanggan
     * @return RedirectResponse Redirect ke halaman Data Pelanggan
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan.index');
    }
}
