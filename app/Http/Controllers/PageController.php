<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function data_anak()
    {
        return view('data-anak');
    }

    public function data_ibu()
    {
        return view('data-ibu');
    }

    public function data_imunisasi()
    {
        return view('data-imunisasi');
    }

    public function riwayat_imunisasi()
    {
        return view('riwayat-imunisasi');
    }

    public function jadwal()
    {
        return view('jadwal');
    }

    public function penimbangan()
    {
        return view('penimbangan');
    }

    public function artikel()
    {
        return view('artikel');
    }

    public function settings()
    {
        return view('settings');
    }
}
