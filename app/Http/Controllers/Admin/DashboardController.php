<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Kendaraan;
use App\Models\RekamServis;
use App\Models\NotaTransaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKonsumen = Konsumen::count();
        $totalKendaraan = Kendaraan::count();
        $servisBerjalan = RekamServis::where('status', 'menunggu_pengerjaan')->count();
        $totalOmzet = NotaTransaksi::where('status_pembayaran', 'lunas')->sum('total_biaya');
        $antreanTerbaru = RekamServis::with('kendaraan.konsumen')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKonsumen', 'totalKendaraan', 'servisBerjalan', 'totalOmzet', 'antreanTerbaru'
        ));
    }
}