<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::latest()->get();
        return view('admin.sparepart.index', compact('spareparts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_modal' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        Sparepart::create($request->all());
        return back()->with('success', 'Sparepart baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Sparepart::findOrFail($id)->delete();
        return back()->with('success', 'Sparepart berhasil dihapus.');
    }
}