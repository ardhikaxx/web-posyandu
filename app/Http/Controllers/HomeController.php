<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use App\Models\DataIbu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        // Menghitung jumlah data anak perempuan (mengantisipasi "Perempuan" atau "P")
        $jumlah_anak_perempuan = DataAnak::where('jenis_kelamin_anak', 'LIKE', 'P%')->count();

        // Menghitung jumlah data anak laki-laki (mengantisipasi "Laki-laki" atau "L")
        $jumlah_anak_laki_laki = DataAnak::where('jenis_kelamin_anak', 'LIKE', 'L%')->count();

        // Menghitung total jumlah data anak
        $jumlah_anak = DataAnak::count();

        // Menghitung total jumlah data orang tua
        $jumlah_orang_tua = DataIbu::count();

        return view('home', compact('jumlah_anak','jumlah_anak_perempuan','jumlah_anak_laki_laki','jumlah_orang_tua'));
    }
    
}
