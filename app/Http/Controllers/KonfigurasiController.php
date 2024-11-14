<?php

namespace App\Http\Controllers;

use App\Models\Konfigurasi;
use Illuminate\Http\Request;

class KonfigurasiController extends Controller
{
    public function index($kd = null) // Parameter KD opsional
    {
        $konfigurasi = null;

        // Jika KD disertakan, ambil data konfigurasi untuk diedit
        if ($kd) {
            $konfigurasi = Konfigurasi::where('kd', $kd)->firstOrFail();
        }

        // Kirim data ke view
        return view('konfigurasi.konfigurasi', compact('konfigurasi'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'popsize' => 'required|integer',
            'generasi' => 'required|integer',
            'crossrate' => 'required|numeric',
            'mutrate' => 'required|numeric',
        ]);

        // Simpan atau perbarui data dengan kd = 1
        Konfigurasi::updateOrCreate(
            ['kd' => 1], // Mencari entri dengan kd = 1
            [
                'popsize' => $request->popsize,
                'generasi' => $request->generasi,
                'crossrate' => $request->crossrate,
                'mutrate' => $request->mutrate,
            ]
        );

        // Redirect dengan pesan sukses
        return redirect()->route('konfigurasi')->with('success', 'Data berhasil disimpan');
    }
}
