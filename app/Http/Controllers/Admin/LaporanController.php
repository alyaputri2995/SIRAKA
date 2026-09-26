<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotaTransaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $transaksi = NotaTransaksi::with(['rekamServis.kendaraan.konsumen', 'rekamServis.detailSpareparts'])
            ->whereBetween('tanggal_cetak', [$startDate, $endDate])
            ->where('status_pembayaran', 'lunas')
            ->latest()
            ->get();

        $pendapatanKotor = $transaksi->sum('total_biaya');

        $totalModalSparepart = 0;
        foreach ($transaksi as $nota) {
            foreach ($nota->rekamServis->detailSpareparts as $sparepart) {
                $totalModalSparepart += ($sparepart->harga_modal_saat_transaksi * $sparepart->qty);
            }
        }

        $labaBersih = $pendapatanKotor - $totalModalSparepart;

        return view('admin.laporan.index', compact(
            'transaksi', 'startDate', 'endDate', 'pendapatanKotor', 'totalModalSparepart', 'labaBersih'
        ));
    }
}