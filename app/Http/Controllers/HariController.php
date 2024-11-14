<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hari;
use Illuminate\Support\Facades\Log;

class HariController extends Controller
{
    protected $primaryKey = 'id_hari';
    
    // Metode untuk menampilkan data
    public function index()
    {
        $hari = Hari::all();
        return view('hari.hari', ['hari' => $hari]);
    }

    //Metode untuk menambahkan data
    public function create()
    {
        Log::info('Create method called');
        return view('hari.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required',
            'sesi' => 'required',
        ]);

        hari::create($validated);
        session()->flash('success', 'Data Berhasil Disimpan!');
        return redirect()->route('hari.index');
    }

    public function edit(hari $hari){
        return view('hari.edit', ['hari' => $hari]);
    }

    // Metode untuk mengedit data
    public function update(Request $request, $id_hari)
    {
        $rules = [
            'hari' => 'required',
            'sesi' => 'required',
        ];

    // Validasi input
    $validated = $request->validate($rules);

    // Update data siswa berdasarkan nisn
    hari::where('id_hari', $id_hari)->update($validated);

    return redirect('hari')->with('success', 'Data Hari Berhasil Diubah!');
       
    } 

    // Metode untuk menghapus data
    public function destroy($id_hari)
    {
        // Hapus data dari database
        Hari::where('id_hari', $id_hari)->delete();
        return redirect('hari')->with('success', 'Data Hari Berhasil Dihapus!');
    }
}
