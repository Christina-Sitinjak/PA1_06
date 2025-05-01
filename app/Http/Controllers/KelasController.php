<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar semua kelas di admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data Kelas, urutkan dari yang terbaru, gunakan paginasi
        $kelas = Kelas::latest()->paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Menampilkan form untuk membuat kelas baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil semua kategori untuk ditampilkan di dropdown
        $semua_kategori = Kategori::all();
        // Tampilkan view 'kelas.create'
        return view('admin.kelas.create', compact('semua_kategori'));
    }

    /**
     * Menyimpan kelas baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id', // Pastikan kategori_id ada di tabel kategoris
            'nama_kelas' => 'required|string|max:255',
            'harga_pendaftaran' => 'required|numeric|min:0',
            'harga_kursus' => 'required|numeric|min:0',
            'masa_belajar' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
        ]);

        // Buat Kelas baru menggunakan data yang sudah divalidasi
        Kelas::create($validatedData);

        // Redirect ke halaman index kelas dengan pesan sukses
        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail spesifik kelas.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas) // Menggunakan Route Model Binding
    {
        // Tampilkan view 'kelas.show' dengan data kelas yang dipilih
        return view('admin.kelas.show', compact('kelas'));
    }

    /**
     * Menampilkan form untuk mengedit kelas.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas) // Menggunakan Route Model Binding
    {
        // Ambil semua kategori untuk ditampilkan di dropdown
        $semua_kategori = Kategori::all();
        // Tampilkan view 'kelas.edit' dengan data kelas yang akan diedit dan daftar kategori
        return view('admin.kelas.edit', compact('kelas', 'semua_kategori'));
    }

    /**
     * Memperbarui kelas yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas) // Menggunakan Route Model Binding
    {
        // Validasi data yang masuk dari form edit
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nama_kelas' => 'required|string|max:255',
            'harga_pendaftaran' => 'required|numeric|min:0',
            'harga_kursus' => 'required|numeric|min:0',
            'masa_belajar' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
        ]);

        // Update data kelas yang ada dengan data yang sudah divalidasi
        $kelas->update($validatedData);

        // Redirect ke halaman index kelas dengan pesan sukses
        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Menghapus kelas dari database.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas) // Menggunakan Route Model Binding
    {
        // Hapus data kelas
        $kelas->delete();

        // Redirect ke halaman index kelas dengan pesan sukses
        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas berhasil dihapus.');
    }

    /**
     * Menampilkan daftar semua kelas untuk publik.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublic()
    {
        $semua_kelas = Kelas::all(); // Ambil semua data kelas
        return view('Kelas.index', compact('semua_kelas')); // Tampilkan detail kelas untuk publik
    }
}
