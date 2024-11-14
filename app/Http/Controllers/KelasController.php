<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Kelasprak;
use Illuminate\Support\Facades\Log;

class KelasController extends Controller
{
    protected $primaryKey = 'id_kelasprak';
    
    // Metode untuk menampilkan data
    public function index()
    {
        $kelasprak = Kelasprak::all();
        return view('kelasprak.kelasprak', ['kelasprak' => $kelasprak]);
    }

    //Metode untuk menambahkan data
    public function create()
    {
        Log::info('Create method called');
        return view('kelasprak.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas' => 'required',
            'hari' => 'required',
            'sesi' => 'required',
        ]);

        Kelasprak::create($validated);
        session()->flash('success', 'Data Berhasil Disimpan!');
        return redirect()->route('kelasprak.index');
    }

    public function edit(Kelasprak $kelasprak){
        return view('kelasprak.edit', ['kelasprak' => $kelasprak]);
    }

    // Metode untuk mengedit data
    public function update(Request $request, $id_kelasprak)
    {
        $rules = [
            'kelas' => 'required',
            'hari' => 'required',
            'sesi' => 'required',
        ];

    // Validasi input
    $validated = $request->validate($rules);

    // Update data siswa berdasarkan nisn
    Kelasprak::where('id_kelasprak', $id_kelasprak)->update($validated);

    return redirect('kelasprak')->with('success', 'Data Kelas Berhasil Diubah!');
       
    } 

    // Metode untuk menghapus data
    public function destroy($id_kelasprak)
    {
        // Hapus data dari database
        Kelasprak::where('id_kelasprak', $id_kelasprak)->delete();
        return redirect('kelas')->with('success', 'Data Kelas Berhasil Dihapus!');
    }
}
