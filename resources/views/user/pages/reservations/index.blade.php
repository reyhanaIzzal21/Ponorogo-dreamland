@extends('user.layouts.app')

@section('style')
    <style>
        /* Custom Hover Effect untuk Card yang Aktif */
        .booking-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Efek saat card di-hover: Naik sedikit + Bayangan menebal */
        .booking-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Styling khusus untuk card yang disabled/coming soon */
        .card-disabled {
            filter: grayscale(100%);
            opacity: 0.8;
            cursor: not-allowed;
            pointer-events: none;
            /* Mencegah klik */
        }
    </style>
@endsection

@section('content')
    <header class="pt-32 pb-16 bg-zinc-50 text-center px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5"
            style="background-image: radial-gradient(var(--color-primary) 1px, transparent 1px); background-size: 20px 20px;">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto reveal active">
            <span
                class="inline-block py-1 px-4 border border-primary/30 text-primary bg-primary/5 rounded-full text-xs font-bold tracking-widest uppercase mb-4">
                Reservation Center
            </span>
            <h1 class="font-serif text-4xl md:text-5xl text-zinc-900 font-bold mb-4 leading-tight">
                Mulai Rencanakan <br class="hidden md:block" /> Momen Berharga Anda
            </h1>
            <p class="font-modern text-lg text-zinc-500 max-w-xl mx-auto">
                Pilih layanan Ponorogo Dreamland yang ingin Anda reservasi di bawah ini.
            </p>
        </div>
    </header>

    <section class="pb-24 bg-zinc-50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">

                @forelse($destinations as $destination)
                    @if ($destination->canBeReserved())
                        {{-- Active/Reservable Destination Card --}}
                        <a href="{{ route('reservation.form', ['destination_id' => $destination->id]) }}"
                            class="group block h-full">
                            <div
                                class="booking-card bg-white rounded-2xl overflow-hidden shadow-lg border border-zinc-100 h-full flex flex-col relative">
                                <div class="h-64 overflow-hidden relative">
                                    <img src="{{ $destination->cover_image_url ?? 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop' }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                                        alt="{{ $destination->name }}">
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="bg-forest-green text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                            Open Daily
                                        </span>
                                    </div>
                                </div>

                                <div class="p-8 flex-1 flex flex-col border-t-4 border-forest-green">
                                    <h3
                                        class="font-heritage text-2xl font-bold text-zinc-800 mb-2 group-hover:text-forest-green transition">
                                        {{ $destination->name }}
                                    </h3>
                                    <p class="text-zinc-500 text-sm mb-6 flex-1 leading-relaxed">
                                        {{ $destination->description ?? 'Deskripsi tidak tersedia.' }}
                                    </p>

                                    <div class="flex items-center text-forest-green font-bold text-sm">
                                        Buat Reservasi
                                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @else
                        {{-- Disabled/Coming Soon Destination Card --}}
                        <div class="block h-full card-disabled relative">
                            <div
                                class="bg-white rounded-2xl overflow-hidden shadow-sm border border-zinc-200 h-full flex flex-col relative">

                                <div class="absolute inset-0 z-20 flex items-center justify-center">
                                    <div
                                        class="bg-zinc-800/90 backdrop-blur-sm border border-zinc-600 text-white px-6 py-3 rounded-xl transform -rotate-6 shadow-2xl">
                                        <span
                                            class="block text-center text-xs text-zinc-400 uppercase tracking-widest mb-1">Status</span>
                                        <span
                                            class="block text-xl font-bold text-secondary tracking-wide">{{ strtoupper($destination->status_label) }}</span>
                                    </div>
                                </div>

                                <div class="h-64 overflow-hidden relative bg-blue-900">
                                    <div class="absolute inset-0 bg-blue-500/30 z-10 mix-blend-overlay"></div>

                                    <img src="{{ $destination->cover_image_url ?? 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=800&auto=format&fit=crop' }}"
                                        class="w-full h-full object-cover opacity-60" alt="{{ $destination->name }}">
                                </div>

                                <div class="p-8 flex-1 flex flex-col border-t-4 border-zinc-300">
                                    <h3 class="font-heritage text-2xl font-bold text-zinc-400 mb-2">
                                        {{ $destination->name }}
                                    </h3>
                                    <p class="text-zinc-400 text-sm mb-6 flex-1 leading-relaxed">
                                        {{ $destination->description ?? 'Deskripsi tidak tersedia.' }}
                                    </p>

                                    <div class="flex items-center text-zinc-400 font-bold text-sm cursor-not-allowed">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Belum Tersedia
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-zinc-500">Belum ada destinasi yang tersedia.</p>
                    </div>
                @endforelse

            </div>

            <div class="mt-12 text-center reveal">
                <p class="text-zinc-400 text-sm">
                    Butuh bantuan langsung? <a href="#" class="text-primary font-bold hover:underline">Chat WhatsApp
                        Admin</a>
                </p>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // Scroll Reveal Animation (Standard script kita)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
@endsection
