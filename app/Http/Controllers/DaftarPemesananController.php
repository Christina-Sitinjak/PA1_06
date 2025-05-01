<?php

namespace App\Http\Controllers;

use App\Models\PesanKelas;
use Illuminate\Http\Request;

class DaftarPemesananController extends Controller // Ubah nama class di sini
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = PesanKelas::with('user', 'kategori', 'kelas')->get(); // Eager load relasi
        return view('admin.daftar_pemesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for approving the specified resource.
     *
     * @param  \App\Models\PesanKelas  $pesanKelas
     * @return \Illuminate\Http\Response
     */
    public function approve(PesanKelas $pesanKelas)
    {
        $pesanKelas->status = 'approved';
        $pesanKelas->save();

        return redirect()->route('admin.daftar_pemesanan.index')->with('success', 'Pemesanan berhasil disetujui!'); // Sesuaikan nama route
    }

    /**
     * Show the form for cancelling the specified resource.
     *
     * @param  \App\Models\PesanKelas  $pesanKelas
     * @return \Illuminate\Http\Response
     */
    public function cancel(PesanKelas $pesanKelas)
    {
        // Kembalikan Stok (Jika mungkin)
        $kelas = \App\Models\Kelas::find($pesanKelas->kelas_id);
        if ($kelas) {
            $kelas->stok++;
            $kelas->save();
        }

        $pesanKelas->status = 'cancelled';
        $pesanKelas->save();

        return redirect()->route('admin.daftar_pemesanan.index')->with('success', 'Pemesanan berhasil dibatalkan!'); // Sesuaikan nama route
    }
}
