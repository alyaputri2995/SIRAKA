<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AturanDiagnosa;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $aturan = AturanDiagnosa::latest()->get();
        return view('admin.diagnosa.index', compact('aturan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kata_kunci' => 'required|string',
            'diagnosa_terkait' => 'required|string',
        ]);

        AturanDiagnosa::create([
            'kata_kunci' => strtolower($request->kata_kunci),
            'diagnosa_terkait' => $request->diagnosa_terkait
        ]);

        return back()->with('success', 'Aturan diagnosa baru berhasil disimpan!');
    }

    public function destroy($id)
    {
        AturanDiagnosa::findOrFail($id)->delete();
        return back()->with('success', 'Aturan diagnosa berhasil dihapus.');
    }
}