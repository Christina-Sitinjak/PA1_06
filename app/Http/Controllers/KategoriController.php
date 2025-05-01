<?php

namespace App\Http\Controllers;

use App\Models\Kategori; // Ganti Pengumuman dengan Kategori
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar semua kategori di admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data Kategori, urutkan dari yang terbaru, gunakan paginasi
        $kategori = Kategori::latest()->paginate(10); // Ganti Pengumuman dengan Kategori
        return view('admin.kategori.index', compact('kategori')); // Ganti view dengan kategori.index
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Tampilkan view 'kategori.create'
        return view('admin.kategori.create'); // Ganti view dengan kategori.create
    }

    /**
     * Menyimpan kategori baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255', // Ganti validasi sesuai field kategori
        ]);

        // Buat Kategori baru menggunakan data yang sudah divalidasi
        Kategori::create($validatedData); // Ganti Pengumuman dengan Kategori

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.kategori.index') // Ganti route dengan kategori.index
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail spesifik kategori.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori) // Menggunakan Route Model Binding
    {
        // Tampilkan view 'kategori.show' dengan data kategori yang dipilih
        return view('admin.kategori.show', compact('kategori')); // Ganti view dengan kategori.show
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori) // Menggunakan Route Model Binding
    {
        // Tampilkan view 'kategori.edit' dengan data kategori yang akan diedit
        return view('admin.kategori.edit', compact('kategori')); // Ganti view dengan kategori.edit
    }

    /**
     * Memperbarui kategori yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori) // Menggunakan Route Model Binding
    {
        // Validasi data yang masuk dari form edit
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255', // Ganti validasi sesuai field kategori
        ]);

        // Update data kategori yang ada dengan data yang sudah divalidasi
        $kategori->update($validatedData); // Ganti Pengumuman dengan Kategori

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.kategori.index') // Ganti route dengan kategori.index
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori) // Menggunakan Route Model Binding
    {
        // Hapus data kategori
        $kategori->delete(); // Ganti Pengumuman dengan Kategori

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.kategori.index') // Ganti route dengan kategori.index
                         ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Menampilkan daftar semua kategori untuk publik.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublic()
    {
        $semua_kategori = Kategori::all(); // Ambil semua data kategori
        return view('Kategori.index', compact('semua_kategori')); // Tampilkan detail Kategori untuk publik
    }
}
