<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategoris = Kategori::all(); // Ambil data kategori
        return view('home', compact('kategoris')); // Kirim ke view 'home'
    }
}
