@extends('layouts.admin')

@section('title', 'Input Servis Baru - SIRAKA')

@section('content')
<div class="max-w-2xl bg-ink-900 p-6 rounded-2xl border border-neutral-800 shadow-sm">
    <h2 class="text-lg font-extrabold text-white mb-1">Input Servis Baru</h2>
    <p class="text-xs text-neutral-500 mb-5">Sistem akan mencocokkan keluhan dengan diagnosa otomatis berbasis keyword.</p>

    <form action="{{ route('admin.rekam-servis.store') }}" method="POST" class="space-y-4 text-xs">
        @csrf
        <div>
            <label class="block font-bold mb-1 text-neutral-300">Pilih Kendaraan *</label>
            <select name="kendaraan_id" required class="w-full p-2.5 bg-neutral-800/60 border border-neutral-700 text-white rounded-xl font-medium focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                <option value="">-- Pilih Kendaraan Konsumen --</option>
                @foreach($kendaraans as $k)
                    <option value="{{ $k->id }}">{{ $k->plat_nomor }} - {{ $k->konsumen->nama_lengkap }} ({{ $k->merk }} {{ $k->tipe_model }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-bold mb-1 text-neutral-300">Kilometer Terkini (KM) *</label>
            <input type="number" name="km_akhir" required class="w-full p-2.5 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500" placeholder="Contoh: 45000">
        </div>
        <div>
            <label class="block font-bold mb-1 text-neutral-300">Keluhan Konsumen *</label>
            <textarea name="keluhan_awal" rows="3" required class="w-full p-2.5 bg-neutral-800/60 border border-neutral-700 text-white placeholder-neutral-500 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500" placeholder="Contoh: rem bunyi saat diinjak, tarikan agak berat"></textarea>
            <span class="text-[10px] text-neutral-500 mt-1 block">Kata kunci akan dicocokkan otomatis ke Master Diagnosa.</span>
        </div>
        <div class="flex justify-end gap-2 pt-2">
            <a href="{{ route('admin.rekam-servis.index') }}" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-neutral-200 rounded-xl font-bold">Batal</a>
            <button type="submit" class="px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white rounded-xl font-bold shadow-md shadow-brand-500/20">Simpan Servis</button>
        </div>
    </form>
</div>
@endsection