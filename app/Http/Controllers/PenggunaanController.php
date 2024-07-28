<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PenggunaanController extends Controller
{
    /**
     * Menampilkan Data-data pelanggan mengenai penggunaan
     * @return View Menampilkan data penggunaan
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        $penggunaan = Penggunaan::orderByDesc('tahun')->orderByDesc('bulan')->get();
//        return view('admin.penggunaan.index', compact('penggunaan'));
        return view('admin.penggunaan.index', compact('pelanggan'));
    }

    /**
     * Menampilkan form tambah data Penggunaan Pelanggan (Admin/User)
     * @param Pelanggan $pelanggan Data Pelanggan untuk mengambil ID
     * @return View Menampilkan Form Tambah Data Penggunaan Pelanggan
     */
    public function create(Pelanggan $pelanggan)
    {
//        $pelanggan = Pelanggan::where('id_pelanggan', $id)->get();
        return view('admin.penggunaan.create', compact('pelanggan'));
    }

    /**
     * Memasukkan data baru kedalam database untuk disimpan
     * @param Request $request Request
     * @return RedirectResponse Redirect Ke Halaman Penggunaan setelah data disimpan
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make(request()->all(), [
            'id_pelanggan' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_akhir' => 'required',
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }
        $penggunaan = new Penggunaan();
        $penggunaan->id_pelanggan = request('id_pelanggan');
        $penggunaan->bulan = request('bulan');
        $penggunaan->tahun = request('tahun');
        $penggunaan->meter_awal = request('meter_awal');
        $penggunaan->meter_akhir = request('meter_akhir');
        $penggunaan->save();
        return redirect()->route('admin.penggunaan.index');
    }

    /**
     * Menampilkan Data-data Detail Penggunaan Pelanggan (Admin/User)
     * @param Pelanggan $pelanggan mengambil data dari model yang diberikan
     * @return View Menampilkan Detail Penggunaan Pelanggan
     */
    public function show(Pelanggan $pelanggan)
    {
        $penggunaan = Penggunaan::where('id_pelanggan', $pelanggan->id_pelanggan)->orderByDesc('tahun')->orderByDesc('bulan')->get();
        return view('admin.penggunaan.detail', compact(['penggunaan', 'pelanggan']));
    }

    /**
     * Menampilkan data spesifik penggunaan pelanggan untuk di edit (Admin/User)
     * @param Penggunaan $detail_penggunaan mengambil data berdasarkan model Penggunaan dengan berdasarakan parameter dari routes
     * @return View Menampilkan Edit Penggunaan Pelanggan
     */
    public function edit(Penggunaan $detail_penggunaan) : View
    {
        return view('admin.penggunaan.edit', ['penggunaan' => $detail_penggunaan]);
    }

    /**
     * Mengupdate data spesifik Penggunaan dan disimpan ke database (Admin/User)
     * @param Request $request mengambil data dari hasil request
     * @param Penggunaan $detail_penggunaan mengambil data berdasarkan model Penggunaan dengan berdasarakan parameter dari routes
     */
    public function update(Request $request, Penggunaan $detail_penggunaan)
    {
        $validatedData = Validator::make(request()->all(), [
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_akhir' => 'required',
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }
        $detail_penggunaan->update([
            'bulan' => $request->get('bulan'),
            'tahun' => $request->get('tahun'),
            'meter_awal' => $request->get('meter_awal'),
            'meter_akhir' => $request->get('meter_akhir')
        ]);
        return redirect()->route('admin.penggunaan.index');
    }

    /**
     * Menghapus data spesifik penggunaan listrik pelanggan (Admin/User)
     * @param Penggunaan $detail_penggunaan Mengambil data yang diberikan
     */
    public function destroy(Penggunaan $detail_penggunaan)
    {
        $detail_penggunaan->delete();
        return redirect()->route('admin.penggunaan.index');
    }

    /**
     * Menampilkan Penggunaan Listrik Pelanggan (Customer/Pelanggan)
     *
     * @return View
     */
    function indexCust()
    {
        $penggunaan = Penggunaan::where('id_pelanggan', '=', Auth::guard('customer')->id())->orderByDesc('tahun')->orderByDesc('bulan')->get();
        return view('customer.penggunaan', ['penggunaan' => $penggunaan]);
    }
}
