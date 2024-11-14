<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asisten;
use Illuminate\Support\Facades\Log;

class AsistenController extends Controller
{
    protected $primaryKey = 'id_asisten';
    
    // Metode untuk menampilkan data
    public function index()
    {
        $asisten = Asisten::all();
        return view('asisten.asisten', ['asisten' => $asisten]);
    }

    //Metode untuk menambahkan data
    public function create()
    {
        Log::info('Create method called');
        return view('asisten.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'required',
            // 'notelp' => 'required|max:13|min:11|unique:asistens',
        ],[
            'nama.required' => 'Nama tidak boleh kosong!',
            // 'notelp.max' => 'Nomor telepon maksimal 13!',
        ]);

        Asisten::create($validated);
        session()->flash('success', 'Data Berhasil Disimpan!');
        return redirect()->route('asisten.index');
    }

    public function edit(asisten $asisten){
        return view('asisten.edit', ['asisten' => $asisten]);
    }

    // Metode untuk mengedit data
    public function update(Request $request, $id_asisten)
    {
        $rules = [
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'required',
            // 'notelp' => 'required|max:13|min:11',
        ];

    // Validasi input
    $validated = $request->validate($rules);

    // Update data siswa berdasarkan nisn
    asisten::where('id_asisten', $id_asisten)->update($validated);

    return redirect('asisten')->with('success', 'Data Asisten Berhasil Diubah!');
       
    } 

    // Metode untuk menghapus data
    public function destroy($id_asisten)
    {
        // Hapus data dari database
        Asisten::where('id_asisten', $id_asisten)->delete();
        return redirect('asisten')->with('success', 'Data Asisten Berhasil Dihapus!');
    }
    
    // public function downloadPDF(){
    //     $siswa = siswa::all();
    //     $pdf = Pdf::loadView('siswa.cetak', ['siswa' => $siswa])->setPaper("A4", "potrait");

    //     return $pdf->stream('report-data-siswa.pdf');
    // }
}
