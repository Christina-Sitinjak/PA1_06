<?php

namespace App\Http\Controllers;

use App\Models\PesanKelas;
use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Rules\ValidJadwal; // Import ValidJadwal rule

class UserPesanKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $pesanans = PesanKelas::where('user_id', $user->id)->with(['kategori', 'kelas'])->get();

        return view('user.pesan_kelas.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semua_kategori = Kategori::all();
        $semua_kelas = Kelas::all(); // Semua program yang tersedia
        return view('user.pesan_kelas.create', compact('semua_kategori', 'semua_kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'tingkatan' => 'required|in:sd,smp,sma',
            'kelas' => 'required|string', // Validasi string karena bisa 3,4,5, dll
            'program' => 'required|exists:kelas,kelas_id',
            'jadwal' => [
                'required',
                new ValidJadwal($request->kategori_id), // Gunakan ValidJadwal rule
            ],
        ]);

        // Cek Stok
        $kelas = Kelas::find($request->program);
        if ($kelas->stok <= 0) {
            return back()->withErrors(['stok' => 'Stok kelas ini sudah habis.'])->withInput();
        }

        // Logika pembatasan pemesanan (DIUBAH)
        $kategori_id = $request->kategori_id;

        // Cari pemesanan dengan status 'pending' atau 'approved'
        $existingPemesananAktif = PesanKelas::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingPemesananAktif) {
            if ($existingPemesananAktif->kategori_id != $kategori_id) {
                return back()->withErrors(['kategori_id' => 'Anda sudah memesan kelas dengan kategori ' . $existingPemesananAktif->kategori->nama_kategori . ' (aktif), tidak bisa memesan kategori lain.'])->withInput();
            }

             // Jika sudah memesan reguler, hanya boleh 2 kali (aktif)
             if ($kategori_id == 1) {
                $jumlahPemesananRegulerAktif = PesanKelas::where('user_id', $user->id)
                    ->where('kategori_id', 1)
                    ->whereIn('status', ['pending', 'approved'])
                    ->count();

                 // Pastikan program sama
                if ($existingPemesananAktif->kelas_id != $request->program) {
                        return back()->withErrors(['program' => 'Anda hanya dapat memesan program yang sama dengan pemesanan pertama Anda (yang masih aktif).'])->withInput();
                }

                 // Validasi jumlah pemesanan (maksimal 2 dengan program yang sama)
                if ($jumlahPemesananRegulerAktif >= 2) {
                        return back()->withErrors(['kategori_id' => 'Anda sudah memesan Reguler Class (aktif) 2 kali, tidak bisa memesan lagi.'])->withInput();
                 }

                 // Memastikan jadwal berbeda
                $jadwal_sama = PesanKelas::where('user_id', $user->id)
                    ->where('kategori_id', 1)
                    ->where('kelas_id', $request->program)
                    ->where('jadwal', $request->jadwal)
                    ->whereIn('status', ['pending', 'approved'])
                    ->exists();

                if ($jadwal_sama) {
                    return back()->withErrors(['jadwal' => 'Anda sudah memesan program ini dengan jadwal yang sama.'])->withInput();
                }
            }

        }

        // Simpan pemesanan
        $pesan = new PesanKelas();
        $pesan->nama = $request->nama;
        $pesan->alamat = $request->alamat;
        $pesan->asal_sekolah = $request->asal_sekolah;
        $pesan->kategori_id = $request->kategori_id;
        $pesan->tingkatan = $request->tingkatan;
        $pesan->user_id = $user->id;
        $pesan->kelas_id = $request->program; //Simpan program id
        $pesan->jadwal = $request->jadwal;
        $pesan->status = 'pending'; // Status default
        $pesan->save();

        // Kurangi Stok
        $kelas->decrement('stok', 1);
        $kelas->save();

        return redirect()->route('user.pesan_kelas.index')
                        ->with('success','Pemesanan kelas berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PesanKelas $pesanKelas)
    {
        // Logika untuk menampilkan detail pemesanan (jika diperlukan)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesanKelas $pesanKelas)
    {
        // Cek apakah user yang mencoba mengedit adalah pemilik pemesanan
        if (Auth::id() !== $pesanKelas->user_id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit pemesanan ini.');
        }

        // Cek apakah status masih pending
        if ($pesanKelas->status !== 'pending') {
            return redirect()->route('user.pesan_kelas.index')->with('error', 'Pemesanan ini sudah di-approve/cancel dan tidak bisa diubah.');
        }

        $semua_kategori = Kategori::all();
        $semua_kelas = Kelas::all();
        return view('user.pesan_kelas.edit', compact('pesanKelas', 'semua_kategori', 'semua_kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesanKelas $pesanKelas)
    {
        // Cek apakah user yang mencoba mengupdate adalah pemilik pemesanan
        if (Auth::id() !== $pesanKelas->user_id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit pemesanan ini.');
        }

        // Cek apakah status masih pending
        if ($pesanKelas->status !== 'pending') {
            return redirect()->route('user.pesan_kelas.index')->with('error', 'Pemesanan ini sudah di-approve/cancel dan tidak bisa diubah.');
        }

         $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'tingkatan' => 'required|in:sd,smp,sma',
            'kelas' => 'required|string', // Validasi string karena bisa 3,4,5, dll
            'program' => 'required|exists:kelas,kelas_id',
            'jadwal' => [
                'required',
                new ValidJadwal($request->kategori_id), // Gunakan ValidJadwal rule
            ],
        ]);

        $pesanKelas->nama = $request->nama;
        $pesanKelas->alamat = $request->alamat;
        $pesanKelas->asal_sekolah = $request->asal_sekolah;
        $pesanKelas->kategori_id = $request->kategori_id;
        $pesanKelas->tingkatan = $request->tingkatan;
        $pesanKelas->kelas_id = $request->program;
        $pesanKelas->jadwal = $request->jadwal;
        $pesanKelas->save();


        return redirect()->route('user.pesan_kelas.index')
                        ->with('success','Pemesanan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesanKelas $pesanKelas)
    {
        // Logika untuk menghapus pemesanan (jika diperlukan)
    }

    public function batalkan($pesan_kelas)
    {
        $pesanKelas = PesanKelas::findOrFail($pesan_kelas);

        // 1. Otentikasi: Pastikan user yang mencoba membatalkan adalah pemilik pemesanan
        if (Auth::id() !== $pesanKelas->user_id) {
            abort(403, 'Anda tidak memiliki izin untuk membatalkan pemesanan ini.');
        }

        // 2. Cek Status: Hanya izinkan pembatalan jika statusnya masih "pending"
        if ($pesanKelas->status !== 'pending') {
            return redirect()->route('user.pesan_kelas.index')->with('error', 'Pemesanan ini tidak dapat dibatalkan karena sudah disetujui atau ditolak.');
        }

        // 3. Lakukan Pembatalan:
        $pesanKelas->status = 'cancelled'; // Ubah status menjadi "cancelled" (atau "batal")
        $pesanKelas->save();

        // Tambahkan logika pengembalian stok (jika perlu)
        $kelas = Kelas::find($pesanKelas->kelas_id);
        if ($kelas) {
            $kelas->increment('stok', 1);
        }


        return redirect()->route('user.pesan_kelas.index')->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}
