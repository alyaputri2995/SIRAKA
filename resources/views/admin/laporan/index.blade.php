@extends('layouts.admin')

@section('title', 'Laporan Pemasukan - SIRAKA')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-extrabold text-white tracking-tight">Laporan Rekapitulasi Pemasukan</h2>
    <p class="text-xs text-neutral-500">Rekapitulasi pendapatan kotor, beban modal sparepart, dan laba bersih.</p>
</div>

<!-- Filter Rentang Tanggal -->
<div class="bg-ink-900 p-4 rounded-2xl border border-neutral-800 mb-6 shadow-sm">
    <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex flex-wrap items-end gap-3 text-xs">
        <div>
            <label class="block font-bold mb-1 text-neutral-400">Dari Tanggal:</label>
            <input type="date" name="start_date" value="{{ $startDate }}" class="p-2 border border-neutral-700 rounded-xl bg-neutral-800/60 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <div>
            <label class="block font-bold mb-1 text-neutral-400">Sampai Tanggal:</label>
            <input type="date" name="end_date" value="{{ $endDate }}" class="p-2 border border-neutral-700 rounded-xl bg-neutral-800/60 text-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <button type="submit" class="px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-xl font-bold flex items-center gap-2 shadow-md shadow-brand-500/20">
            <i class="fa-solid fa-filter"></i>
            <span>Terapkan Filter</span>
        </button>
        <button type="button" onclick="window.print()" class="px-4 py-2.5 bg-neutral-800 hover:bg-neutral-700 text-neutral-200 rounded-xl font-bold flex items-center gap-2 ml-auto border border-neutral-700">
            <i class="fa-solid fa-print"></i>
            <span>Cetak Rekap</span>
        </button>
    </form>
</div>

<!-- Kartu Ringkasan -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-ink-900 p-5 rounded-2xl border border-neutral-800 shadow-sm">
        <span class="text-neutral-500 text-xs font-semibold uppercase">Total Pendapatan Kotor</span>
        <div class="text-xl font-extrabold text-white mt-1">Rp {{ number_format($pendapatanKotor, 0, ',', '.') }}</div>
    </div>
    <div class="bg-ink-900 p-5 rounded-2xl border border-neutral-800 shadow-sm">
        <span class="text-neutral-500 text-xs font-semibold uppercase">Total Modal Sparepart</span>
        <div class="text-xl font-extrabold text-rose-400 mt-1">Rp {{ number_format($totalModalSparepart, 0, ',', '.') }}</div>
    </div>
    <div class="bg-ink-900 p-5 rounded-2xl border border-neutral-800 shadow-sm">
        <span class="text-neutral-500 text-xs font-semibold uppercase">Keuntungan Bersih (Laba)</span>
        <div class="text-xl font-extrabold text-emerald-400 mt-1">Rp {{ number_format($labaBersih, 0, ',', '.') }}</div>
    </div>
</div>

<!-- Tabel Transaksi Lunas -->
<div class="bg-ink-900 rounded-2xl border border-neutral-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-neutral-400 min-w-[640px]">
            <thead class="bg-black/40 border-b border-neutral-800 uppercase font-bold text-neutral-500">
                <tr>
                    <th class="p-4">No. Nota</th>
                    <th class="p-4">Tgl Selesai</th>
                    <th class="p-4">Kendaraan / Konsumen</th>
                    <th class="p-4">Total Biaya</th>
                    <th class="p-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-800">
                @forelse ($transaksi as $item)
                    <tr class="hover:bg-neutral-800/40 transition">
                        <td class="p-4 font-bold text-brand-400">{{ $item->no_nota }}</td>
                        <td class="p-4">{{ $item->tanggal_cetak }}</td>
                        <td class="p-4">
                            <span class="font-bold text-white">{{ $item->rekamServis->kendaraan->plat_nomor }}</span>
                            <span class="text-neutral-500">({{ $item->rekamServis->kendaraan->konsumen->nama_lengkap }})</span>
                        </td>
                        <td class="p-4 font-bold text-white">Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                        <td class="p-4 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 uppercase">
                                {{ $item->status_pembayaran }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-neutral-600">Tidak ada transaksi pada periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection