@extends('layouts.admin')

@section('title', 'Data Konsumen - SIRAKA')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-extrabold text-white tracking-tight">Data Konsumen & Kendaraan</h2>
        <p class="text-xs text-neutral-500">Mendukung relasi satu konsumen ke banyak unit kendaraan (Multi-Unit).</p>
    </div>
    <button onclick="document.getElementById('modalTambahKonsumen').classList.remove('hidden')" class="px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-xl text-xs font-bold shadow-md shadow-brand-500/20 flex items-center gap-2 w-fit">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Konsumen Baru</span>
    </button>
</div>

<!-- Tabel: tampil di layar >= sm -->
<div class="hidden sm:block bg-ink-900 rounded-2xl border border-neutral-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-neutral-400">
            <thead class="bg-black/40 border-b border-neutral-800 uppercase font-bold text-neutral-500">
                <tr>
                    <th class="p-4">Konsumen</th>
                    <th class="p-4">No. HP / WhatsApp</th>
                    <th class="p-4">Kendaraan Terdaftar</th>
                    <th class="p-4 text-center">Jumlah Unit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-800">
                @forelse ($konsumen as $item)
                    <tr class="hover:bg-neutral-800/40 transition">
                        <td class="p-4 font-bold text-white">{{ $item->nama_lengkap }}</td>
                        <td class="p-4 font-medium text-neutral-400">{{ $item->no_hp }}</td>
                        <td class="p-4">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($item->kendaraans as $mobil)
                                    <span class="px-2 py-0.5 rounded bg-neutral-800 border border-neutral-700 text-neutral-300 text-[11px] font-bold">
                                        {{ $mobil->plat_nomor }} ({{ $mobil->merk }} {{ $mobil->tipe_model }})
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <span class="px-2.5 py-0.5 rounded-full bg-brand-500/10 text-brand-400 font-bold">
                                {{ $item->kendaraans->count() }} Unit
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-8 text-center text-neutral-600">Belum ada data konsumen.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Kartu list: tampil di mobile -->
<div class="sm:hidden space-y-3">
    @forelse ($konsumen as $item)
        <div class="bg-ink-900 rounded-2xl border border-neutral-800 p-4 shadow-sm">
            <div class="flex items-start justify-between mb-1">
                <h3 class="font-bold text-white text-sm">{{ $item->nama_lengkap }}</h3>
                <span class="px-2 py-0.5 rounded-full bg-brand-500/10 text-brand-400 text-[10px] font-bold flex items-center gap-1">
                    <i class="fa-solid fa-car"></i> {{ $item->kendaraans->count() }} Kendaraan
                </span>
            </div>
            <p class="text-xs text-neutral-500 mb-3">{{ $item->no_hp }}</p>
            <div class="flex flex-wrap gap-1.5">
                @foreach($item->kendaraans as $mobil)
                    <span class="px-2 py-0.5 rounded bg-neutral-800 border border-neutral-700 text-neutral-300 text-[11px] font-bold">
                        {{ $mobil->plat_nomor }}
                    </span>
                @endforeach
            </div>
        </div>
    @empty
        <div class="p-8 text-center text-neutral-600 text-xs bg-ink-900 rounded-2xl border border-neutral-800">Belum ada data konsumen.</div>
    @endforelse
</div>

<!-- Modal Tambah Konsumen -->
<div id="modalTambahKonsumen" class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-ink-900 border border-neutral-800 rounded-2xl w-full max-w-lg p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4 border-b border-neutral-800 pb-3">
            <h3 class="font-extrabold text-sm text-white">Tambah Konsumen & Mobil</h3>
            <button onclick="document.getElementById('modalTambahKonsumen').classList.add('hidden')" class="text-neutral-500 hover:text-white">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form action="{{ route('admin.konsumen.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div class="p-3 bg-black/40 rounded-xl space-y-2 border border-neutral-800">
                <span class="font-extrabold text-neutral-500 uppercase text-[10px]">Data Pemilik</span>
                <div>
                    <label class="block font-bold mb-1 text-neutral-300">Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" required class="w-full p-2 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                </div>
                <div>
                    <label class="block font-bold mb-1 text-neutral-300">Nomor HP/WhatsApp *</label>
                    <input type="text" name="no_hp" required class="w-full p-2 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500" placeholder="08xxxxxxxxxx">
                </div>
            </div>

            <div class="p-3 bg-black/40 rounded-xl space-y-2 border border-neutral-800">
                <span class="font-extrabold text-neutral-500 uppercase text-[10px]">Data Unit Pertama</span>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block font-bold mb-1 text-neutral-300">Nomor Polisi (Plat) *</label>
                        <input type="text" name="plat_nomor" required class="w-full p-2 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500" placeholder="BM 1234 XX">
                    </div>
                    <div>
                        <label class="block font-bold mb-1 text-neutral-300">Tahun</label>
                        <input type="number" name="tahun" class="w-full p-2 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500" placeholder="2021">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block font-bold mb-1 text-neutral-300">Merk (Toyota, Honda, dll) *</label>
                        <input type="text" name="merk" required class="w-full p-2 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                    </div>
                    <div>
                        <label class="block font-bold mb-1 text-neutral-300">Tipe / Model (Avanza, Brio) *</label>
                        <input type="text" name="tipe_model" required class="w-full p-2 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalTambahKonsumen').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-neutral-200 rounded-xl font-bold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white rounded-xl font-bold shadow-md shadow-brand-500/20">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection