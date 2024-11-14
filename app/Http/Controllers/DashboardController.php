<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use App\Models\Kelasprak;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $asisten = Asisten::count();
        $kelas = Kelasprak::count();

        return view('dashboard', compact('asisten', 'kelas'));
    }
}
