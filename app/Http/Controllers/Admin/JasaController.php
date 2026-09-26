<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        $jasas = Jasa::latest()->get();
        return view('admin.jasa.index', compact('jasas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jasa' => 'required',
            'harga' => 'required|numeric',
        ]);

        Jasa::create($request->all());
        return back()->with('success', 'Jasa servis baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Jasa::findOrFail($id)->delete();
        return back()->with('success', 'Jasa berhasil dihapus.');
    }
}