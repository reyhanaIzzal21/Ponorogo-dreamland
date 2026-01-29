@extends('user.layouts.app')

@section('style')
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <style>
        /* Restaurant Page Body Override */
        body {
            background-color: #FFF8E1;
        }
    </style>
@endsection

@section('content')
    {{-- HERO SECTION --}}
    @php
        $heroTitle = $heroSection->title ?? 'Cita Rasa Tradisional';
        $heroSubtitle = $heroSection->subtitle ?? 'di Jantung Ponorogo';
        $heroDescription =
            $heroSection->description ??
            'Nikmati hidangan warisan leluhur dengan sentuhan modern, disajikan dalam kehangatan suasana kekeluargaan.';
        $heroBgImage =
            $heroSection?->getExtraValue('background_image') ??
            'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop';
        if ($heroBgImage && !str_starts_with($heroBgImage, 'http')) {
            $heroBgImage = asset('storage/' . $heroBgImage);
        }
    @endphp
    <section class="relative h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $heroBgImage }}" alt="Suasana Dam Cokro" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-heritage-red opacity-40 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-black/30"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto fade-up">
            <h1 class="font-heritage text-5xl md:text-7xl text-white font-bold mb-6 drop-shadow-lg leading-tight">
                {{ $heroTitle }} <br>
                <span class="italic font-light text-golden-cokro">{{ $heroSubtitle }}</span>
            </h1>
            <p class="font-modern text-lg text-gray-100 mb-10 max-w-2xl mx-auto font-light tracking-wide">
                {{ $heroDescription }}
            </p>

            <a href="{{ route('menu') }}"
                class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-forest-green transition-all duration-200 bg-golden-cokro font-modern rounded-full hover:bg-[#ffcf40] hover:scale-105 shadow-[0_0_20px_rgba(251,192,45,0.4)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-golden-cokro">
                <span>Lihat Menu</span>
                <svg class="w-5 h-5 ml-2 -mr-1 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                    </path>
                </svg>
            </a>
        </div>
    </section>

    {{-- BEST SELLER SECTION --}}
    <section class="py-24 bg-parchment">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-up">
                <h3 class="text-heritage-red font-bold tracking-widest uppercase text-sm mb-2">Pilihan Chef</h3>
                <h2 class="font-heritage text-4xl md:text-5xl text-forest-green font-bold">Menu Andalan Kami</h2>
                <div class="w-24 h-1 bg-golden-cokro mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($bestSellers as $index => $bestSeller)
                    @php
                        $menu = $bestSeller->menuItem;
                        $imageUrl =
                            $menu?->image_url ??
                            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1000';
                        $emoji = ['🌶️', '🥘', '🥤'][$index] ?? '🍽️';
                    @endphp
                    <div class="group relative bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 fade-up border border-golden-cokro/20"
                        style="transition-delay: {{ $index * 100 }}ms;">
                        <div class="h-72 overflow-hidden relative">
                            <img src="{{ $imageUrl }}" alt="{{ $menu?->name ?? 'Menu' }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            <div
                                class="absolute top-4 right-4 bg-golden-cokro text-black text-xs font-bold px-3 py-2 rounded-lg shadow-md uppercase tracking-wider">
                                ★ Best Seller
                            </div>
                        </div>
                        <div class="p-8 text-center relative">
                            <div
                                class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-parchment rounded-full flex items-center justify-center border border-golden-cokro">
                                <span class="text-xl">{{ $emoji }}</span>
                            </div>
                            <h3 class="font-heritage text-2xl font-bold text-forest-green mb-2 mt-4">
                                {{ $menu?->name ?? 'Menu Item' }}</h3>
                            <p class="text-gray-600 text-sm mb-4 font-modern line-clamp-2">{{ $menu?->description ?? '' }}
                            </p>
                            <p class="font-heritage text-2xl text-heritage-red font-bold">Rp
                                {{ number_format($menu?->price ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    {{-- Fallback if no best sellers --}}
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Menu best seller akan segera hadir!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- MENU TABS SECTION - Dynamic Random Menu --}}
    <section class="py-20 bg-white relative">
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none"
            style="background-image: radial-gradient(#1B5E20 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-10 fade-up">
                <h2 class="font-heritage text-4xl text-forest-green font-bold mb-6">Jelajahi Rasa</h2>
            </div>

            <div id="menuContent" class="min-h-[100px] fade-up">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($randomMenus ?? [] as $menu)
                        <div class="flex items-center gap-4 p-4 border rounded-lg hover:shadow-md transition bg-parchment">
                            <img src="{{ $menu->image_url ?? 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150' }}"
                                class="w-20 h-20 rounded-lg object-cover" alt="{{ $menu->name }}">
                            <div>
                                <h4 class="font-bold text-forest-green font-heritage">{{ $menu->name }}</h4>
                                <span class="text-heritage-red font-bold text-sm">Rp
                                    {{ number_format($menu->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 text-center py-8">
                            <p class="text-gray-500">Menu akan segera hadir!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ url('/menu') }}"
                    class="inline-block text-heritage-red border-b-2 border-heritage-red font-bold hover:text-forest-green hover:border-forest-green transition pb-1">
                    Lihat Buku Menu Lengkap &rarr;
                </a>
            </div>
        </div>
    </section>

    {{-- FILOSOFI SECTION --}}
    @php
        $filosofiTitle = $filosofiSection->title ?? 'Lebih dari Sekadar Tempat Makan';
        $filosofiDesc = $filosofiSection->description ?? '"Dam Cokro" bukan hanya nama, tapi sebuah janji...';
        $filosofiParagraphs = explode("\n\n", $filosofiDesc);
    @endphp
    <section class="py-24 bg-forest-green text-parchment relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 mix-blend-overlay"
            style="background-image: url('https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1000&auto=format&fit=crop');">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 fade-up">
                    <h3 class="text-golden-cokro font-bold tracking-widest uppercase text-sm mb-4">Filosofi Kami</h3>
                    <h2 class="font-heritage text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                        {!! nl2br(e($filosofiTitle)) !!}
                    </h2>
                    @foreach ($filosofiParagraphs as $paragraph)
                        <p class="font-modern text-lg opacity-90 mb-6 leading-relaxed">
                            {{ trim($paragraph) }}
                        </p>
                    @endforeach
                </div>

                <div class="lg:w-1/2 relative fade-up" style="transition-delay: 200ms;">
                    <div class="absolute -top-4 -left-4 w-24 h-24 border-t-4 border-l-4 border-golden-cokro"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 border-b-4 border-r-4 border-golden-cokro"></div>
                    <img src="{{ asset('assets/images/damcokro.jpeg?q=80&w=1000&auto=format&fit=crop') }}"
                        class="w-full h-[500px] object-cover rounded-lg shadow-2xl filter sepia-[.3] grayscale-[.5] hover:grayscale-0 transition duration-700">
                </div>
            </div>
        </div>
    </section>

    {{-- GALLERY SECTION --}}
    @php
        $instagramUsername = $heroSection?->getExtraValue('instagram_username') ?? 'ponorogo.dreamland';
        $instagramUrl = $heroSection?->getExtraValue('instagram_url') ?? 'https://instagram.com/ponorogo.dreamland';
    @endphp
    <section class="py-24 bg-parchment">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 fade-up">
                <div>
                    <h2 class="font-heritage text-4xl text-forest-green font-bold mb-2">Sudut Estetik</h2>
                    <p class="text-gray-600">Abadikan momen terbaikmu di Dam Cokro.</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-2">
                    <a href="{{ $instagramUrl }}" target="_blank"
                        class="bg-linear-to-tr from-yellow-400 via-red-500 to-purple-500 text-white px-4 py-2 rounded-lg font-bold text-sm flex items-center gap-2 hover:shadow-lg transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                        {{ '@' . $instagramUsername }}
                    </a>
                </div>
            </div>

            {{-- Gallery Grid: Mobile-first responsive layout --}}
            {{-- Mobile: 2 cols, Desktop: 3 cols (1 large left spanning 2 rows + 3 smaller right) --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 fade-up">
                @php
                    $galleryCount = $galleryImages->count();
                @endphp

                @if ($galleryCount >= 1)
                    @php
                        $img1 = $galleryImages[0];
                        $img1Url = $img1->image_path;
                        if ($img1Url && !str_starts_with($img1Url, 'http')) {
                            $img1Url = asset('storage/' . $img1Url);
                        }
                    @endphp
                    {{-- Large image: full width on mobile, 1 col spanning 2 rows on desktop --}}
                    <div
                        class="col-span-2 md:col-span-1 md:row-span-2 relative rounded-2xl overflow-hidden group aspect-[4/3] md:aspect-auto">
                        <img src="{{ $img1Url }}" alt="{{ $img1->alt_text ?? 'Gallery image 1' }}"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110 md:min-h-[380px]">
                    </div>
                @endif

                @if ($galleryCount >= 2)
                    @php
                        $img2 = $galleryImages[1];
                        $img2Url = $img2->image_path;
                        if ($img2Url && !str_starts_with($img2Url, 'http')) {
                            $img2Url = asset('storage/' . $img2Url);
                        }
                    @endphp
                    {{-- Small image: 1 col on both mobile and desktop --}}
                    <div class="col-span-1 relative rounded-2xl overflow-hidden group aspect-square">
                        <img src="{{ $img2Url }}" alt="{{ $img2->alt_text ?? 'Gallery image 2' }}"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    </div>
                @endif

                @if ($galleryCount >= 3)
                    @php
                        $img3 = $galleryImages[2];
                        $img3Url = $img3->image_path;
                        if ($img3Url && !str_starts_with($img3Url, 'http')) {
                            $img3Url = asset('storage/' . $img3Url);
                        }
                    @endphp
                    {{-- Small image: 1 col on both mobile and desktop --}}
                    <div class="col-span-1 relative rounded-2xl overflow-hidden group aspect-square">
                        <img src="{{ $img3Url }}" alt="{{ $img3->alt_text ?? 'Gallery image 3' }}"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    </div>
                @endif

                @if ($galleryCount >= 4)
                    @php
                        $img4 = $galleryImages[3];
                        $img4Url = $img4->image_path;
                        if ($img4Url && !str_starts_with($img4Url, 'http')) {
                            $img4Url = asset('storage/' . $img4Url);
                        }
                    @endphp
                    {{-- Bottom image: full width on mobile, 2 cols on desktop --}}
                    <div class="col-span-2 relative rounded-2xl overflow-hidden group aspect-[2/1]">
                        <img src="{{ $img4Url }}" alt="{{ $img4->alt_text ?? 'Gallery image 4' }}"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    </div>
                @endif

                @if ($galleryCount == 0)
                    {{-- Fallback when no images --}}
                    <div
                        class="col-span-2 md:col-span-1 md:row-span-2 relative rounded-2xl overflow-hidden group aspect-[4/3] md:aspect-auto">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1000&auto=format&fit=crop"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110 md:min-h-[380px]">
                    </div>
                    <div class="col-span-1 relative rounded-2xl overflow-hidden group aspect-square">
                        <img src="https://images.unsplash.com/photo-1550966871-3ed3c6227685?q=80&w=500&auto=format&fit=crop"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    </div>
                    <div class="col-span-1 relative rounded-2xl overflow-hidden group aspect-square">
                        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=500&auto=format&fit=crop"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    </div>
                    <div class="col-span-2 relative rounded-2xl overflow-hidden group aspect-[2/1]">
                        <img src="https://images.unsplash.com/photo-1592861956120-e524fc739696?q=80&w=500&auto=format&fit=crop"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('user.pages.destinations.restaurant.scripts.index')
@endsection
