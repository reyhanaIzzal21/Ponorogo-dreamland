@extends('user.layouts.app')

@php
    $destinationId = request('destination_id');
    $destination = \App\Models\Destination::find($destinationId);

    // Fallback or specific logic based on destination type
    $type = $destination ? $destination->type : 'restaurant'; // Default
    $title = $destination ? 'Reservasi ' . $destination->name : 'Reservasi';
    $image = $destination
        ? $destination->cover_image_url
        : 'https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=800';
    $themeColor = 'primary';
    $themeHex = '#2D7D32';

    if ($type == 'venue') {
        $themeColor = 'earth';
        $themeHex = '#795548';
    }
@endphp

@section('style')
    <style>
        .input-dynamic:focus {
            --tw-ring-color: {{ $themeHex }};
            border-color: {{ $themeHex }};
            outline: 2px solid {{ $themeHex }};
        }
    </style>
@endsection

@section('content')
    <div class="bg-zinc-900 pt-28 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-30 bg-cover bg-center"
            style="background-image: url('{{ $image }}'); filter: blur(8px);"></div>
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold tracking-widest uppercase mb-2">
                Step 2 of 2
            </span>
            <h1 class="font-serif text-3xl md:text-4xl text-white font-bold">{{ $title }}</h1>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-24">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">

            <div class="w-full md:w-1/3 bg-zinc-50 border-r border-zinc-100 p-8">
                <div class="sticky top-8">
                    <h3 class="font-bold text-zinc-800 text-lg mb-4">Detail Pilihan</h3>

                    <div class="bg-white p-4 rounded-xl border border-zinc-200 shadow-sm mb-6 flex items-start gap-4">
                        <img src="{{ $image }}" class="w-16 h-16 rounded-lg object-cover">
                        <div>
                            <p class="text-xs text-zinc-500 uppercase font-bold">{{ $type }}</p>
                            <h4 class="font-heritage font-bold text-{{ $themeColor }} text-lg">
                                {{ $destination->name ?? 'Unknown Destination' }}
                            </h4>
                            <a href="{{ route('reservation') }}"
                                class="text-xs text-zinc-400 underline hover:text-zinc-600">Ganti Venue</a>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-zinc-500">Konfirmasi otomatis via WhatsApp.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-2/3 p-8 md:p-12">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reservation.store') }}" method="POST" id="reservationForm">
                    @csrf
                    <input type="hidden" name="destination_id" value="{{ $destinationId }}">

                    <div class="mb-10">
                        <h2 class="font-serif text-2xl text-zinc-800 font-bold mb-6 flex items-center gap-2">
                            <span
                                class="w-8 h-8 rounded-full bg-{{ $themeColor }} text-white text-sm flex items-center justify-center">1</span>
                            Data Pemesan
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-bold text-zinc-700 mb-2">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="user_name" value="{{ old('user_name') }}" required
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                    placeholder="Contoh: Budi Santoso">
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-bold text-zinc-700 mb-2">WhatsApp <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="user_whatsapp" value="{{ old('user_whatsapp') }}" required
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                    placeholder="0812xxxx">
                            </div>
                        </div>
                    </div>

                    <hr class="border-dashed border-zinc-200 my-8">

                    <div class="mb-10">
                        <h2 class="font-serif text-2xl text-zinc-800 font-bold mb-6 flex items-center gap-2">
                            <span
                                class="w-8 h-8 rounded-full bg-{{ $themeColor }} text-white text-sm flex items-center justify-center">2</span>
                            Detail Reservasi
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal</label>
                                <input type="date" name="reservation_date" value="{{ old('reservation_date') }}"
                                    required
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-zinc-700 mb-2">Jumlah Orang</label>
                                <input type="number" name="number_of_people" value="{{ old('number_of_people') }}"
                                    min="1" required
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                    placeholder="Contoh: 4">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-zinc-700 mb-2">Kebutuhan</label>
                                <input type="text" name="needs" value="{{ old('needs') }}" required
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                    placeholder="Contoh: Ulang tahun, request kursi bayi, dll.">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-zinc-700 mb-2">Catatan Tambahan</label>
                                <textarea name="notes"
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm h-24"
                                    placeholder="Contoh: Ulang tahun, request kursi bayi, dll.">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <button type="submit"
                        class="w-full bg-{{ $themeColor }} hover:opacity-90 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center gap-2 text-lg">
                        Buat Reservasi
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
