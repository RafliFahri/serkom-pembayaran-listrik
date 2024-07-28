<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TarifController extends Controller
{
    /**
     * Menampilkan Data-data Tarif (Admin/User)
     *
     * Mengambil data dari database menggunakan Eloquent dengan mengambill seluruh data yang add
     *
     * @return View
     */
    public function index()
    {
        $tarif = Tarif::all();
        return view('admin.tarif.index', compact('tarif'));
    }

    /**
     * Menampilkan form untuk menambahkan data tarif (Admin/user)
     *
     * @return View View tampilan form tambah data
     */
    public function create()
    {
        return view('admin.tarif.create');
    }

    /**
     * Memasukkan data dari form request untuk disimpan kedalam database (Admin/User)
     *
     * @param Request $request Data request
     * @return RedirectResponse Redirect ke halaman tarif
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'daya' => 'required',
            'tarifperkwh' => 'required',
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }
        $modelTarif = new Tarif();
        $modelTarif->daya = $request->input('daya');
        $modelTarif->tarifperkwh = $request->input('tarifperkwh');
        $modelTarif->save();
        return redirect()->route('admin.tarif.index');
    }

    /**
     * Menampilkan data spesifik untuk di edit (Admin/User)
     *
     * @return View Tampilan View Form edit
     */
    public function edit(Tarif $tarif)
    {
        return view('admin.tarif.edit', compact('tarif'));
    }

    /**
     * Mengupdate data yang spesifik untuk diupdate di database (Admin/User)
     *
     * @param Request $request Request data
     * @param Tarif $tarif ID tarif dari Model Tarif
     */
    public function update(Request $request, Tarif $tarif)
    {
        $validatedData = Validator::make($request->all(), [
            'daya' => 'required',
            'tarifperkwh' => 'required',
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }

        $tarif->update([
            'daya'=>$request->get('daya'),
            'tarifperkwh'=>$request->get('tarifperkwh'),
        ]);
        return redirect()->route('admin.tarif.index');
    }

    /**
     * Menghapus data yang spesifik dari database
     *
     * @param Tarif $tarif ID tarif dari Model Tarif
     * @return RedirectResponse Redirect ke halaman tarif
     */
    public function destroy(Tarif $tarif)
    {
        $tarif->delete();
        return redirect()->route('admin.tarif.index');
    }
}
