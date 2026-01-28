@extends('admin.layouts.app')

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen">
        <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <a href="{{ route('admin.reservation.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-700 mb-2 inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Detail Reservasi #{{ substr($reservation->id, 0, 8) }}</h1>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Main Detail --}}
            <div class="col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Informasi Tamu</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Nama Lengkap</p>
                        <p class="text-gray-900 font-medium">{{ $reservation->user_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">WhatsApp</p>
                        <div class="flex items-center gap-2">
                            <a href="https://wa.me/{{ $reservation->user_whatsapp }}" target="_blank"
                                class="text-green-600 font-bold hover:underline">
                                {{ $reservation->user_whatsapp }}
                            </a>
                            @if ($reservation->wa_sent)
                                <span
                                    class="bg-green-100 text-green-800 text-[10px] font-bold px-2 py-0.5 rounded-full">Sent</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-[10px] font-bold px-2 py-0.5 rounded-full">Failed</span>
                            @endif
                        </div>
                    </div>
                </div>

                <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Detail Acara</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Destination</p>
                        <p class="text-gray-900 font-medium">{{ $reservation->destination->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Tanggal</p>
                        <p class="text-gray-900 font-medium">{{ $reservation->reservation_date->format('l, d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Jumlah Orang</p>
                        <p class="text-gray-900 font-medium">{{ $reservation->number_of_people }} Orang</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Keperluan</p>
                        <p class="text-gray-900 font-medium">{{ $reservation->needs }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Catatan Tambahan</p>
                    <p class="text-gray-800 italic">{{ $reservation->notes ?: '-' }}</p>
                </div>
            </div>

            {{-- Sidebar Status/Actions --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6 h-fit">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Status & Notifikasi</h3>

                <div class="mb-4">
                    <p class="text-xs text-gray-500 mb-1">Resevation Status</p>
                    <span
                        class="inline-block px-3 py-1 rounded bg-{{ $reservation->status == 'confirmed' ? 'green' : ($reservation->status == 'pending' ? 'yellow' : 'gray') }}-100 text-{{ $reservation->status == 'confirmed' ? 'green' : ($reservation->status == 'pending' ? 'yellow' : 'gray') }}-800 font-bold uppercase text-sm">
                        {{ $reservation->status }}
                    </span>
                </div>

                <div class="mb-6">
                    <p class="text-xs text-gray-500 mb-1">WhatsApp Notification</p>
                    @if ($reservation->wa_sent)
                        <div
                            class="flex items-center gap-2 text-green-600 bg-green-50 p-2 rounded-lg border border-green-100">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-sm font-bold">Terkirim</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Pada: {{ $reservation->wa_sent_at->format('d/m/Y H:i') }}</p>
                    @else
                        <div
                            class="flex items-center gap-2 text-red-600 bg-red-50 p-2 rounded-lg border border-red-100 mb-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            <span class="text-sm font-bold">Gagal</span>
                        </div>
                        @if ($reservation->wa_error)
                            <p class="text-xs text-red-500 mb-2">{{ $reservation->wa_error }}</p>
                        @endif

                        <form action="{{ route('admin.reservation.resend', $reservation->id) }}" method="POST">
                            @csrf
                            <button
                                class="w-full py-2 bg-gray-900 text-white rounded-lg text-sm font-bold hover:bg-gray-800 transition">
                                Kirim Ulang WA
                            </button>
                        </form>
                    @endif
                </div>

                <div class="border-t pt-4">
                    <p class="text-xs text-gray-500 mb-1">Dibuat Pada</p>
                    <p class="text-sm font-medium">{{ $reservation->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
