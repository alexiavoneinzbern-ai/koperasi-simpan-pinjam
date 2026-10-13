<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function index(Request $request)
    {
        $pokok = $request->input('pokok', 10000000);
        $tenor = $request->input('tenor', 12);
        $bungaPercent = $request->input('bunga', 1);

        $angsuranPokok = $pokok / ($tenor ?: 1);
        $angsuranBunga = $pokok * ($bungaPercent / 100);
        $totalAngsuran = $angsuranPokok + $angsuranBunga;

        return view('simulation', compact('pokok', 'tenor', 'bungaPercent', 'angsuranPokok', 'angsuranBunga', 'totalAngsuran'));
    }
}
