@extends('layouts.admin')

@section('title', 'Daftar Rekam Servis - SIRAKA')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-extrabold text-white tracking-tight">Daftar Rekam Servis</h2>
        <p class="text-xs text-neutral-500">Pantau proses pengerjaan servis dan koreksi diagnosa fisik mekanik.</p>
    </div>
    <a href="{{ route('admin.rekam-servis.create') }}" class="px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-xl text-xs font-bold shadow-md shadow-brand-500/20 flex items-center gap-2 w-fit">
        <i class="fa-solid fa-plus"></i><span>Input Servis Baru</span>
    </a>
</div>

<!-- Tabel: tampil di layar >= sm -->
<div class="hidden sm:block bg-ink-900 rounded-2xl border border-neutral-800 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-neutral-400 min-w-[720px]">
            <thead class="bg-black/40 border-b border-neutral-800 font-bold text-neutral-500">
                <tr>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Kendaraan</th>
                    <th class="p-3">Diagnosa Awal</th>
                    <th class="p-3">Diagnosa Akhir</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-800">
                @forelse($servis as $item)
                <tr class="hover:bg-neutral-800/40 transition">
                    <td class="p-3">{{ $item->tanggal_servis }}</td>
                    <td class="p-3 font-bold text-white">
                        {{ $item->kendaraan->plat_nomor }}
                        <div class="text-[11px] font-normal text-neutral-500">{{ $item->kendaraan->konsumen->nama_lengkap }}</div>
                    </td>
                    <td class="p-3">{{ $item->diagnosa_awal }}</td>
                    <td class="p-3 font-semibold text-emerald-400">{{ $item->diagnosa_akhir ?? 'Menunggu cek fisik' }}</td>
                    <td class="p-3 text-center">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $item->status == 'menunggu_pengerjaan' ? 'bg-amber-500/10 text-amber-400' : 'bg-emerald-500/10 text-emerald-400' }}">
                            {{ str_replace('_', ' ', $item->status) }}
                        </span>
                    </td>
                    <td class="p-3 text-right">
                        @if($item->status == 'menunggu_pengerjaan')
                            <a href="{{ route('admin.rekam-servis.koreksi-form', $item->id) }}" class="px-3 py-1 bg-brand-500 hover:bg-brand-600 text-white rounded-lg font-bold text-[11px]">
                                Koreksi Diagnosa
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-8 text-center text-neutral-600">Belum ada riwayat servis.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Kartu list: tampil di mobile, mirror mockup timeline riwayat servis -->
<div class="sm:hidden space-y-3">
    @forelse($servis as $item)
        <div class="bg-ink-900 rounded-2xl border border-neutral-800 p-4 shadow-sm">
            <div class="flex items-start justify-between mb-2">
                <div>
                    <h3 class="font-bold text-white text-sm">{{ $item->kendaraan->plat_nomor }}</h3>
                    <p class="text-[11px] text-neutral-500">{{ $item->kendaraan->konsumen->nama_lengkap }} &middot; {{ $item->tanggal_servis }}</p>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $item->status == 'menunggu_pengerjaan' ? 'bg-amber-500/10 text-amber-400' : 'bg-emerald-500/10 text-emerald-400' }}">
                    {{ str_replace('_', ' ', $item->status) }}
                </span>
            </div>
            <div class="text-xs space-y-1 mb-3">
                <p class="text-neutral-500">Diagnosa Awal: <span class="text-neutral-300 font-semibold">{{ $item->diagnosa_awal }}</span></p>
                <p class="text-neutral-500">Diagnosa Akhir: <span class="text-emerald-400 font-semibold">{{ $item->diagnosa_akhir ?? 'Menunggu cek fisik' }}</span></p>
            </div>
            @if($item->status == 'menunggu_pengerjaan')
                <a href="{{ route('admin.rekam-servis.koreksi-form', $item->id) }}" class="block text-center w-full py-2 bg-brand-500 text-white rounded-xl font-bold text-xs">
                    Koreksi Diagnosa
                </a>
            @endif
        </div>
    @empty
        <div class="p-8 text-center text-neutral-600 text-xs bg-ink-900 rounded-2xl border border-neutral-800">Belum ada riwayat servis.</div>
    @endforelse
</div>
@endsection