<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class TagihanController extends Controller
{
    /**
     * Menampilkan View Tagihan ke Customer untuk di proses dan ke admin berdasarkan id_pelanggan
     * @version 2
     * @param Pelanggan $pelanggan ID pelanggan dari Model Pelanggan
     * @return View Tampilan Detail tagihan
     */
    public function show(Pelanggan $pelanggan)
    {
        $tagihan = Tagihan::where('id_pelanggan', $pelanggan->id_pelanggan)->orderByDesc('tahun')->orderByDesc('bulan')->get();
        return view('admin.tagihan.index', compact('tagihan', 'pelanggan'));
    }

    /**
     * Mengupdate data secara spesifik dan disimpan ke database (Customer/Pelanggan)
     * Melakukan proses tagihan yang mengubah status tagihan
     *
     * @param Int $tagihan ID tagihan
     * @return RedirectResponse Redirect ke halaman Tagihan (Customer/Pelanggan)
     */
    public function update(Int $tagihan): RedirectResponse
    {
        // Proses Tagihan dengan menggunakan proedure dari database MySQL
        $proses = Tagihan::prosesTagihan($tagihan);
        if ($proses){
            // Redirect Ke Halaman Utama
            return redirect()->route('customer.tagihan');
        }
        return redirect()->back();
    }

    /**
     * Admin menghapus tagihan di detail_tagihan (Admin/User)
     *
     * @param Tagihan $detail_tagihan Model Tagihan/ID tagihan
     * @return RedirectResponse Method ini Melayani Route admin/penggunaan/detail_tagihan atau admin.penggunaan.detail_penggunaan
     */
    public function destroy(Tagihan $detail_tagihan)
    {
        $detail_tagihan->delete();
        return redirect()->route('admin.penggunaan.index');
    }

    /**
     * Menampilkan data Pembayaran pengguna
     *
     * @return View Menampilakan penggunaan yang belum di konfirmasi
     *
     */
    public function indexCust()
    {
        // Kode ini menggunakan Kombinasi Eloquent dan Query Builder sebagai penunjang
        // fungsionalitas aplikasi terutama fitur ini yang membutuhkan query kompleks
        // untuk mendapatkan data yang sesuai
        $tagihan = Pembayaran::join('tagihan as t', 'pembayaran.id_tagihan', '=', 't.id_tagihan')
            ->join('pelanggan as pel', 'pembayaran.id_pelanggan', '=', 'pel.id_pelanggan')
            ->select([
                'pembayaran.id_pembayaran',
                'pembayaran.id_tagihan',
                'pel.nama_pelanggan',
                't.jumlah_meter',
                'pembayaran.total_bayar',
                'pembayaran.biaya_admin',
                'pembayaran.bulan_bayar',
                't.status',
            ])
            ->where('pembayaran.id_pelanggan', '=', Auth::guard('customer')->user()->id_pelanggan)
            ->orderBy('pembayaran.id_pembayaran', 'desc')
            ->get();
        return view('customer.tagihan', compact('tagihan'));
    }
}
