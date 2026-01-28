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
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="reservationManager">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Reservation Data</h1>
                <p class="text-gray-500 text-sm mt-1">Pantau semua reservasi masuk dari Website.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <div class="flex gap-3 w-full md:w-auto">
                    {{-- Form Removed, handled by Alpine --}}
                    <a :href="exportUrl" class="flex-1 md:flex-none px-4 py-2 bg-emerald-600 text-white rounded-lg ...">
                        <!-- ikon + teks -->
                        Export Excel
                    </a>
                </div>
            </div>
        </div>

        {{-- Statistics Cards (Optional - can be made dynamic later) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">ALL
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Total Reservasi</p>
                    <h4 class="text-xl font-bold text-gray-800">{{ $reservations->total() }}</h4>
                </div>
            </div>
            <div
                class="bg-white p-4 rounded-xl border border-red-200 shadow-sm flex items-center gap-4 relative overflow-hidden">
                <div class="absolute right-0 top-0 p-1 bg-red-500 text-white text-[10px] font-bold rounded-bl">ALERT</div>
                <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">WA Failed</p>
                    <h4 class="text-xl font-bold text-red-600">{{ $waFailedCount }} Pesan</h4>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            {{-- Filters & Search --}}
            <div class="p-4 border-b border-gray-100 flex flex-col md:flex-row gap-4 justify-between">
                <div class="relative w-full md:w-64">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 ">
                        <select x-model="filter"
                            class="pl-4 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="all">Semua</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                            @endforeach
                        </select>
                        <div class="relative flex-1 md:flex-none">
                            <input type="date" x-model="date"
                                class="pl-4 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="relative md:w-64">
                            <input type="text" x-model="search" placeholder="Cari nama atau no WA..."
                                class="pl-9 pr-4 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">

                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="p-4 font-bold text-left">Tamu</th>
                            <th class="p-4 font-bold text-left">Jadwal</th>
                            <th class="p-4 font-bold text-left">Jumlah Org</th>
                            <th class="p-4 font-bold text-left">Keperluan</th>
                            <th class="p-4 font-bold text-left">Catatan</th>
                            <th class="p-4 font-bold text-center">Status WA</th>
                            <th class="p-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm" id="reservations-table-body">
                        @include('admin.pages.reservations.partials.table')
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t border-gray-100">
                <div id="reservations-pagination">
                    {!! $reservations->links() !!}
                </div>
            </div>

        </div>

    </div>
@endsection

@include('admin.pages.reservations.scripts.index')
