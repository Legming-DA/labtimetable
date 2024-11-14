<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use App\Models\Kelasprak;
use App\Models\Ketersediaan;
use Illuminate\Http\Request;

class KetersediaanController extends Controller
{
    public function index()
    {
        $ketersediaan = Ketersediaan::all();
        return view('ketersediaan.ketersediaan', ['ketersediaan' => $ketersediaan]);
    }

    //Metode untuk menambahkan data
    public function create()
    {
        $tersediaList = Kelasprak::pluck('kelas', 'id_kelasprak');
        $tersediaList2 = Asisten::pluck('nama', 'id_asisten');
        return view('ketersediaan.create', compact('tersediaList','tersediaList2'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_asisten' => 'required',
            'id_kelasprak' => 'required',
        ]);

        Ketersediaan::create($validated);
        session()->flash('success', 'Data Berhasil Disimpan!');
        return redirect()->route('ketersediaan.index');
    }

    public function edit(Ketersediaan $ketersediaan){

        $tersediaList = Kelasprak::pluck('kelas', 'id_kelasprak');
        $tersediaList2 = Asisten::pluck('nama', 'id_asisten');
        return view('ketersediaan.edit', compact('ketersediaan', 'tersediaList','tersediaList2'));
    }

    // Metode untuk mengedit data
    public function update(Request $request, $id)
    {
        $rules = [
            'id_asisten' => 'required',
            'id_kelasprak' => 'required',
        ];

    // Validasi input
    $validated = $request->validate($rules);

    // Update data aturan berdasarkan kode aturan terpilih
    Ketersediaan::where('id', $id)->update($validated);

    return redirect('ketersediaan')->with('success', 'Data Berhasil Diubah!');
       
    }

    // Metode untuk menghapus data
    public function destroy($id)
    {
        Ketersediaan::where('id', $id)->delete();
        return redirect('ketersediaan')->with('success', 'Data Berhasil Dihapus!');
    }

    // public function downloadPDF(){
    //     $aturan = Ketersediaan::all();
    //     $pdf = Pdf::loadView('aturan.cetak', ['aturan' => $aturan])->setPaper("A4", "potrait");

    //     return $pdf->stream('report-data-aturan.pdf');
    // }
}
