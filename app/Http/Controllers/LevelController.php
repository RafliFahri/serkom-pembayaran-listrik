<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use League\CommonMark\Exception\LogicException;

class LevelController extends Controller
{
    /**
     * Menampilkan seluruh data level
     *
     * @return View Menampilakn halaman data level
     */
    public function index()
    {
        $level = Level::all();
//        return view('level.index');
        return view('admin.level.index', compact('level'));
    }

    /**
     * Menampilkan form tambah data level
     *
     * @return View Menampilkan form tambah data level
     */
    public function create()
    {
        return view('admin.level.create');
    }

    /**
     * Memasukkan data level ke dalam database
     *
     * @param Request $request request data
     * @return RedirectResponse Redirect ke halaman Data level
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nama_level' => 'required | unique:level',
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }
        $modelLevel = new Level();
        $modelLevel->nama_level = $request->input('nama_level');
        $modelLevel->save();
        return redirect()->route('admin.level.index');
    }

    /**
     * Menampilkan data level yang spesifik untuk di edit di form
     *
     * @param Level $level Model Level beserta id-nya
     * @return View Menampilkan Form untuk edit Data Level
     */
    public function edit(Level $level)
    {
        return view('admin.level.edit', compact('level'));
    }

    /**
     * Mengupdate data Level yang spesifik untuk diupdate di database
     *
     * @param Request $request Request data
     * @param Level $level Model level beserta id level
     * @return RedirectResponse Redirect ke halaman data Level
     */
    public function update(Request $request, Level $level)
    {
        $validatedData = Validator::make($request->all(), [
            'nama_level' => 'required',
        ]);
        if ($validatedData->fails()) {
            return back()->withErrors($validatedData);
        }
        $level->update([
            "nama_level" => $request->input('nama_level')
        ]);
        return redirect()->route('admin.level.index');
    }

    /**
     * Menghapus data Level di dalam database
     *
     * @param Level $level Model level beserta id-nya
     * @return RedirectResponse Redirect ke halaman Data Level
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.level.index');
    }
}
