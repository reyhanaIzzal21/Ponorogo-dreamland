@extends('admin.layouts.app')

@section('style')
    <style>
        /* Status Badges for Reservation */
        .badge-pending {
            @apply bg-yellow-100 text-yellow-800 border-yellow-200;
        }

        .badge-confirmed {
            @apply bg-green-100 text-green-800 border-green-200;
        }

        .badge-cancelled {
            @apply bg-red-100 text-red-800 border-red-200;
        }

        .badge-completed {
            @apply bg-blue-100 text-blue-800 border-blue-200;
        }

        /* Table Row Hover */
        .hover-row:hover td {
            @apply bg-gray-50;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Reservation Data</h1>
                <p class="text-gray-500 text-sm mt-1">Pantau semua reservasi masuk dari Website.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <form action="{{ route('admin.reservation.index') }}" method="GET" class="flex gap-3 w-full md:w-auto">
                    <div class="relative flex-1 md:flex-none">
                        <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                            class="w-full pl-4 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <a href="{{ route('admin.reservation.export') }}"
                        class="flex-1 md:flex-none px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 flex items-center justify-center gap-2 text-sm font-bold shadow-md transition transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Export Excel
                    </a>
                </form>
            </div>
        </div>

        {{-- Statistics Cards (Optional - can be made dynamic later) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">ALL
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Total Reservasi</p>
                    <h4 class="text-xl font-bold text-gray-800">{{ $reservations->total() }}</h4>
                </div>
            </div>
            {{-- More stats can be added here --}}
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            {{-- Filters & Search --}}
            <div class="p-4 border-b border-gray-100 flex flex-col md:flex-row gap-4 justify-between">
                <div class="flex gap-2 text-sm">
                    {{-- tambah filter bedasarkan jenis destinasi seperti  restaurant, vanue, atau recreation  --}}
                    <a href="{{ route('admin.reservation.index') }}"
                        class="px-3 py-1.5 rounded-lg font-bold transition {{ !request('status') ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-600' }}">Semua</a>
                </div>
                <div class="relative w-full md:w-64">
                    <form action="{{ route('admin.reservation.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama atau no WA..."
                            class="w-full pl-9 pr-4 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="p-4 font-bold">Tamu & Kontak</th>
                            <th class="p-4 font-bold">Venue & Waktu</th>
                            <th class="p-4 font-bold">Detail</th>
                            <th class="p-4 font-bold">Kebutuhan</th>
                            <th class="p-4 font-bold text-center">Catatan</th>
                            <th class="p-4 font-bold text-center">Status Pesan</th>
                            <th class="p-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse ($reservations as $item)
                            <tr class="hover-row transition duration-150">
                                <td class="p-4">
                                    <p class="font-bold text-gray-900">{{ $item->user_name }}</p>
                                    <div class="flex items-center gap-1 text-gray-500 text-xs mt-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        <span>{{ $item->user_whatsapp }}</span>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide mb-1 inline-block bg-indigo-50 text-indigo-700">
                                        {{ $item->destination->name }}
                                    </span>
                                    <p class="font-medium text-gray-800">{{ $item->reservation_date->format('d M Y') }}</p>
                                </td>

                                <td class="p-4">
                                    <p class="text-gray-800"><span class="font-bold">{{ $item->number_of_people }}</span>
                                        Org</p>
                                    <p class="text-gray-500 text-xs italic truncate w-32">{{ $item->needs }}</p>
                                </td>

                                <td class="p-4 text-center">
                                    <span class="text-gray-800 text-xs italic truncate w-32">
                                        {{ $item->notes }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="text-gray-800 text-xs italic truncate w-32">
                                        {{ $item->needs }}
                                    </span>
                                </td>

                                {{-- ini adalah status pesan whatsaap --}}
                                <td class="p-4 text-center">
                                    @if ($item->wa_sent)
                                        <span class="text-green-600 font-bold">Terkirim</span>
                                        <p class="text-gray-500 text-xs mt-1">
                                            {{ $item->wa_sent_at->format('d M Y H:i') }}
                                        </p>
                                    @else
                                        <form action="{{ route('admin.reservation.resend', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-600 font-bold hover:underline"
                                                title="Klik untuk kirim ulang">
                                                Kirim Ulang
                                            </button>
                                        </form>
                                        <p class="text-gray-500 text-xs mt-1">
                                            {{ Str::limit($item->wa_error, 20) }}
                                        </p>
                                    @endif
                                </td>

                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.reservation.show', $item->id) }}"
                                        class="inline-block px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold hover:bg-indigo-100 transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-gray-500">
                                    Tidak ada data reservasi ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t border-gray-100">
                {{ $reservations->links() }}
            </div>
        </div>

    </div>
@endsection
