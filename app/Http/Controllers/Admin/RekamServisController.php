<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamServis;
use App\Models\Kendaraan;
use App\Models\AturanDiagnosa;
use App\Models\Sparepart;
use App\Models\Jasa;
use App\Models\NotaTransaksi;
use Illuminate\Http\Request;

class RekamServisController extends Controller
{
    public function index()
    {
        $servis = RekamServis::with(['kendaraan.konsumen'])->latest()->get();
        return view('admin.rekam-servis.index', compact('servis'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::with('konsumen')->get();
        return view('admin.rekam-servis.create', compact('kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required',
            'km_akhir' => 'required|numeric',
            'keluhan_awal' => 'required|string',
        ]);

        // Keyword Matching Otomatis
        $diagnosaAwal = 'General Check-up / Pemeriksaan Menyeluruh';
        $keluhan = strtolower($request->keluhan_awal);
        $aturanList = AturanDiagnosa::all();

        foreach ($aturanList as $aturan) {
            $keywords = explode(',', $aturan->kata_kunci);
            foreach ($keywords as $kw) {
                if (str_contains($keluhan, trim($kw))) {
                    $diagnosaAwal = $aturan->diagnosa_terkait;
                    break 2;
                }
            }
        }

        RekamServis::create([
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_servis' => now()->toDateString(),
            'km_akhir' => $request->km_akhir,
            'keluhan_awal' => $request->keluhan_awal,
            'diagnosa_awal' => $diagnosaAwal,
            'status' => 'menunggu_pengerjaan',
        ]);

        return redirect()->route('admin.rekam-servis.index')->with('success', 'Rekam servis berhasil dicatat!');
    }

    public function formKoreksi($id)
    {
        $servis = RekamServis::with('kendaraan.konsumen')->findOrFail($id);
        return view('admin.rekam-servis.koreksi', compact('servis'));
    }

    public function simpanKoreksi(Request $request, $id)
    {
        $request->validate([
            'diagnosa_akhir' => 'required|string',
            'tindakan_servis' => 'required|string',
        ]);

        $servis = RekamServis::findOrFail($id);
        $servis->update([
            'diagnosa_akhir' => $request->diagnosa_akhir,
            'tindakan_servis' => $request->tindakan_servis,
            'status' => 'siap_cetak_nota',
        ]);

        return redirect()->route('admin.rekam-servis.index')->with('success', 'Diagnosa akhir fisik mekanik berhasil diperbarui!');
    }
}