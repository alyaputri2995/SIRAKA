<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumen = Konsumen::with('kendaraans')->latest()->get();
        return view('admin.konsumen.index', compact('konsumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|unique:konsumens,no_hp',
            'plat_nomor' => 'required|unique:kendaraans,plat_nomor',
            'merk' => 'required|string',
            'tipe_model' => 'required|string',
            'tahun' => 'nullable|numeric'
        ]);

        DB::transaction(function () use ($request) {
            $konsumen = Konsumen::create([
                'nama_lengkap' => $request->nama_lengkap,
                'no_hp' => $request->no_hp,
            ]);

            Kendaraan::create([
                'konsumen_id' => $konsumen->id,
                'plat_nomor' => strtoupper(str_replace(' ', '', $request->plat_nomor)),
                'merk' => $request->merk,
                'tipe_model' => $request->tipe_model,
                'tahun' => $request->tahun,
            ]);
        });

        return back()->with('success', 'Konsumen dan kendaraan berhasil didaftarkan!');
    }
}