@extends('user.layouts.app')

@section('style')
    <style>
        /* Custom Pattern untuk Background Section Spesifikasi */
        .bg-javanese-pattern {
            background-color: var(--color-zinc-50);
            background-image: radial-gradient(var(--color-earth) 0.5px, transparent 0.5px);
            background-size: 20px 20px;
            opacity: 1;
        }

        /* Styling List Fasilitas */
        .check-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .check-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--color-primary);
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    {{-- Hero Section --}}
    @php
        $heroTitle = $heroSection?->title ?? 'Ruang Elegan untuk';
        $highlightedTitle = $heroSection?->getExtraValue('highlighted_title') ?? 'Momen Istimewa Anda';
        $heroDescription =
            $heroSection?->description ??
            'Pendopo Ponorogo Dreamland menghadirkan perpaduan arsitektur tradisional Jawa yang agung dengan fasilitas modern untuk berbagai kebutuhan acara.';
        $heroBackground = $heroSection?->background_image
            ? (str_starts_with($heroSection->background_image, 'http')
                ? $heroSection->background_image
                : asset('storage/' . $heroSection->background_image))
            : 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2070&auto=format&fit=crop';
        $badgeText = $heroSection?->getExtraValue('badge_text') ?? 'Venue & Events';
        $ctaText = $heroSection?->getExtraValue('cta_text') ?? 'Cek Ketersediaan & Paket';
    @endphp

    <header class="relative h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $heroBackground }}" alt="Pendopo Grand Hall" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-zinc-900/40 mix-blend-multiply"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto reveal active">
            <span
                class="inline-block py-1 px-4 border border-zinc-200 text-zinc-100 uppercase tracking-widest text-xs font-semibold mb-4 bg-white/10 backdrop-blur-md rounded-full">
                {{ $badgeText }}
            </span>
            <h1 class="font-serif text-5xl md:text-7xl text-white font-bold mb-6 drop-shadow-lg leading-tight">
                {{ $heroTitle }} <br /><span class="text-secondary italic">{{ $highlightedTitle }}</span>
            </h1>
            <p class="font-sans text-lg md:text-xl text-zinc-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
                {{ $heroDescription }}
            </p>

            <a href="#inquiry"
                class="inline-block bg-secondary text-earth hover:bg-yellow-300 font-bold px-8 py-4 rounded-full transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-yellow-300/50">
                {{ $ctaText }}
            </a>
        </div>
    </header>

    {{-- Specs Section --}}
    @php
        $specsTitle = $specsSection?->title ?? 'Spesifikasi Venue';
        $specsItems = $specsSection?->specs_items ?? [
            ['title' => 'Kapasitas Tamu', 'desc' => '500 - 800', 'subtitle' => 'Seated / Standing'],
            ['title' => 'Dimensi Ruang', 'desc' => '20 x 30 m', 'subtitle' => 'Tanpa Pilar Tengah'],
            ['title' => 'Material Lantai', 'desc' => 'Granit HQ', 'subtitle' => 'Aksen Kayu Jati'],
            ['title' => 'Kenyamanan', 'desc' => 'Semi-Outdoor', 'subtitle' => 'Mist Fan / AC Option'],
        ];
        $specIcons = [
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        ];
        $specColors = ['earth', 'primary', 'earth', 'primary'];
    @endphp

    <section class="py-20 bg-javanese-pattern border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="font-serif text-3xl md:text-4xl text-earth font-bold mb-4">{{ $specsTitle }}</h2>
                <div class="w-16 h-1 bg-primary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 reveal">
                @foreach ($specsItems as $index => $spec)
                    @php
                        $color = $specColors[$index % count($specColors)];
                        $icon = $specIcons[$index % count($specIcons)];
                    @endphp
                    <div
                        class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-{{ $color }} hover:shadow-md transition group">
                        <div
                            class="w-12 h-12 bg-zinc-100 rounded-full flex items-center justify-center text-{{ $color }} mb-4 group-hover:bg-{{ $color }} group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $icon !!}
                            </svg>
                        </div>
                        <h3 class="text-zinc-500 text-sm font-bold uppercase tracking-wide mb-1">{{ $spec['title'] }}</h3>
                        <p class="font-serif text-2xl text-zinc-800 font-bold">{{ $spec['desc'] }}</p>
                        @if (!empty($spec['subtitle']))
                            <p class="text-xs text-zinc-400 mt-1">{{ $spec['subtitle'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Facilities Section --}}
    @php
        $facilitiesTitle = $facilitiesSection?->title ?? 'Segala yang Anda Butuhkan';
        $facilitiesDescription =
            $facilitiesSection?->description ??
            'Kami memahami bahwa kelancaran acara bergantung pada fasilitas pendukung. Paket sewa Pendopo sudah termasuk:';
        $facilitiesImagePath = $facilitiesSection?->image_path;
        $facilitiesImage = $facilitiesImagePath
            ? (str_starts_with($facilitiesImagePath, 'http')
                ? $facilitiesImagePath
                : asset('storage/' . $facilitiesImagePath))
            : 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=900&auto=format&fit=crop';
    @endphp

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <div class="lg:w-1/2 relative reveal">
                    <img src="{{ $facilitiesImage }}"
                        class="rounded-lg shadow-xl w-full object-cover h-[500px] z-10 relative">
                    <div class="absolute -bottom-6 -right-6 w-2/3 h-64 bg-zinc-100 rounded-lg z-0"></div>
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary/10 rounded-full z-0 blur-2xl"></div>
                </div>

                <div class="lg:w-1/2 reveal" style="transition-delay: 200ms;">
                    <h4 class="text-primary font-bold uppercase tracking-widest text-sm mb-2">Fasilitas Inklusif</h4>
                    <h2 class="font-serif text-3xl md:text-4xl text-zinc-900 font-bold mb-6">{{ $facilitiesTitle }}</h2>
                    <p class="text-zinc-600 mb-8 leading-relaxed">
                        {{ $facilitiesDescription }}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        @forelse($facilities as $facility)
                            <div class="flex items-start gap-3">
                                <div
                                    class="shrink-0 w-8 h-8 rounded-full {{ $facility->icon_bg_color ?? 'bg-green-50' }} flex items-center justify-center {{ $facility->icon_color ?? 'text-primary' }} mt-1 text-lg">
                                    {{ $facility->icon }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-800">{{ $facility->title }}</h4>
                                    <p class="text-sm text-zinc-500">{{ $facility->description }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-start gap-3">
                                <div
                                    class="shrink-0 w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-primary mt-1">
                                    🔊
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-800">Sound System Standard</h4>
                                    <p class="text-sm text-zinc-500">4 Speaker Aktif, Mixer, 2 Wireless Mic.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Flexibility/Layout Section --}}
    <section class="py-24 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="font-serif text-3xl md:text-4xl text-earth font-bold mb-4">Fleksibilitas Ruang</h2>
                <p class="text-zinc-500">Inspirasi layout untuk berbagai jenis acara Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 reveal">
                @forelse($layouts as $layout)
                    @php
                        $imageUrl = str_starts_with($layout->image_path, 'http')
                            ? $layout->image_path
                            : asset('storage/' . $layout->image_path);
                    @endphp
                    <div class="group relative overflow-hidden rounded-xl cursor-pointer h-72">
                        <img src="{{ $imageUrl }}"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <p class="text-white font-serif text-xl border-b border-secondary pb-1">{{ $layout->title }}
                            </p>
                        </div>
                    </div>
                @empty
                    {{-- Fallback static layouts --}}
                    <div class="group relative overflow-hidden rounded-xl cursor-pointer h-72">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1000&auto=format&fit=crop"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <p class="text-white font-serif text-xl border-b border-secondary pb-1">Wedding Setup</p>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-xl cursor-pointer h-72">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1000&auto=format&fit=crop"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <p class="text-white font-serif text-xl border-b border-secondary pb-1">Seminar / Workshop</p>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-xl cursor-pointer h-72">
                        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1000&auto=format&fit=crop"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <p class="text-white font-serif text-xl border-b border-secondary pb-1">Social Gathering</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section id="inquiry" class="py-20 relative overflow-hidden bg-earth">
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('https://www.transparenttextures.com/patterns/wood-pattern.png');"></div>

        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center reveal">
            <h2 class="font-serif text-3xl md:text-5xl text-white font-bold mb-6">Rencanakan Acara Anda Bersama Kami</h2>
            <p class="text-zinc-200 text-lg mb-10 leading-relaxed">
                Dapatkan penawaran terbaik untuk paket Wedding, Meeting, atau acara spesial lainnya. Tim kami siap membantu
                merealisasikan visi Anda.
            </p>

            <div class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 inline-block w-full max-w-lg">
                <div class="flex flex-col gap-4">
                    <a href="https://wa.me/6282252222650"
                        class="bg-secondary hover:bg-yellow-300 text-earth font-bold py-4 px-6 rounded-lg w-full flex items-center justify-center gap-2 transition shadow-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                        Hubungi Marketing (WhatsApp)
                    </a>
                </div>
            </div>

            <p class="mt-6 text-sm text-zinc-300">
                Alamat: Ponorogo Dreamland, Jl. Raya Ponorogo No. 123.<br>
                Buka untuk survey lokasi setiap hari: 09.00 - 17.00 WIB
            </p>
        </div>
    </section>
@endsection

@section('script')
    @include('user.pages.destinations.pavilion.scripts.index')
@endsection
