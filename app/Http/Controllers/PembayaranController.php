<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PembayaranController extends Controller
{
    /**
     * Menampilkan Data Riwayat Pembayaran Pelanggan yang sudah dikonfirmasi
     *
     * @return View Menampilkan data riwayat pembayaran
     */
    public function index()
    {
        $pembayaran = Pembayaran::join('tagihan as t', 'pembayaran.id_tagihan', '=', 't.id_tagihan')
            ->join('pelanggan as pel', 'pembayaran.id_pelanggan', '=', 'pel.id_pelanggan')
            ->join('user as u', 'pembayaran.id_user', '=', 'u.id_user')
            ->select([
                'pembayaran.id_pembayaran',
                'pembayaran.id_tagihan',
                'pel.nama_pelanggan',
                'pel.nomor_kwh',
                'pembayaran.tanggal_pembayaran',
                'pembayaran.total_bayar',
                't.tahun',
                'pembayaran.bulan_bayar',
                'u.nama_admin',
                't.status',
            ])
            ->where('t.status', '=', 1)
            ->orderBy('t.tahun', 'desc')
            ->orderBy('pembayaran.bulan_bayar', 'desc')
            ->orderBy('pembayaran.tanggal_pembayaran', 'desc')
            ->get();
        return view('admin.pembayaran.index', compact('pembayaran')); // Riwayat Pembayaran
    }

    /**
     * Menampilkan data pembayaran yang belum di konfirmasi
     *
     * @return View Manampilkan data pembayaran yang belum dikonfirmasi
     */
    public function show()
    {
        $pembayaran = Pembayaran::join('tagihan as t', 'pembayaran.id_tagihan', '=', 't.id_tagihan')
            ->join('pelanggan as pel', 'pembayaran.id_pelanggan', '=', 'pel.id_pelanggan')
            ->select([
                'pembayaran.id_pembayaran',
                'pembayaran.id_tagihan',
                'pel.nama_pelanggan',
                'pel.nomor_kwh',
                't.jumlah_meter',
                'pembayaran.tanggal_pembayaran',
                'pembayaran.total_bayar',
                'pembayaran.biaya_admin',
                'pembayaran.bulan_bayar',
                't.status',
                't.tahun',
            ])
            ->where('t.status', '=', 0)
            ->orderBy('t.tahun', 'desc')
            ->orderBy('pembayaran.bulan_bayar', 'desc')
            ->orderBy('pembayaran.tanggal_pembayaran', 'desc')
            ->get();
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Mengupdate data Tagihan dan Pembayaran dengan menggunakan trigger mysql (Admin/User)
     *
     * Admin Melakukan Konfirmasi Pembayaran
     *
     * @param Pembayaran $pembayaran ID tagihan dari Model Pembayaran yang dibawa oleh model
     * @return RedirectResponse Redirect ke halaman pembayaran
     */
    public function update(Pembayaran $pembayaran)
    {
        $confirm = Pembayaran::confirmBayar($pembayaran->id_tagihan, Auth::guard('admin')->id());
        if ($confirm){
            return redirect()->route('admin.pembayaran.show');
        }
        return redirect()->back();
    }
}
