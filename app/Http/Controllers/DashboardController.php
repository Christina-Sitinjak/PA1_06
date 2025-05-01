<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Galeri;
use App\Models\Pengajar;
use App\Models\ProfilAlumni;
use App\Models\Pengumuman;
use App\Models\Kategori;


class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKelas        = Kelas::count();
        $jumlahGaleri       = Galeri::count();
        $jumlahPengajar     = Pengajar::count();
        $jumlahAlumni       = ProfilAlumni::count();
        $jumlahPengumuman   = Pengumuman::count();
        $jumlahKategori     = Kategori::count();

            return view('admin.dashboard', compact(
                'jumlahKelas',
                'jumlahGaleri',
                'jumlahPengajar',
                'jumlahAlumni',
                'jumlahPengumuman',
                'jumlahKategori'
            ));
    }
}
