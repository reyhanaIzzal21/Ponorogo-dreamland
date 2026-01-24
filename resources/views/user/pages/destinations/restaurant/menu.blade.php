@extends('user.layouts.app')

@section('style')
    <style>
        /* Hide Scrollbar for Horizontal Nav */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Smooth Scroll Behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Sticky Nav Active State */
        .nav-link.active {
            background-color: var(--color-heritage-red);
            color: white;
            border-color: var(--color-heritage-red);
        }

        /* Adjust scroll position for fixed header */
        section {
            scroll-margin-top: 140px;
        }
    </style>
@endsection

@php
    // === DATA DUMMY STRUCTURE (Backend Simulation) ===
    // 'type' determines the layout: 'grid-photo', 'package-list', 'price-group'
    $categories = [
        [
            'id' => 'promo',
            'name' => 'Combo Nikmat',
            'type' => 'grid-promo', // Tampilan Besar
            'items' => [
                [
                    'name' => 'Paket Combo 1',
                    'desc' => '1 Nasi Campur + 1 Ice Lemontea/Milo',
                    'price' => '23.000',
                    'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c',
                ],
                [
                    'name' => 'Paket Combo 2',
                    'desc' => '1 Chicken Steak Crispy + 1 Ice Lemontea/Milo',
                    'price' => '23.000',
                    'image' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d',
                ],
                [
                    'name' => 'Paket Combo 3',
                    'desc' => '1 Spaghetti Ayam + 1 Ice Lemontea/Milo',
                    'price' => '23.000',
                    'image' => 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8',
                ],
            ],
        ],
        [
            'id' => 'prasmanan',
            'name' => 'Paket Prasmanan',
            'type' => 'package-list', // Tampilan List tanpa foto per item
            'items' => [
                [
                    'name' => 'Paket Yudistira',
                    'price' => '52.500/pax',
                    'contents' => [
                        'Nasi Putih',
                        'Sambal',
                        'Kerupuk',
                        'Buah Segar',
                        'Teh/Kopi',
                        'Es Campur',
                        'Brokoli Jamur',
                        'Sop Galantin',
                        'Ayam Bakar/Goreng',
                        'Ikan Saos Lada Hitam',
                    ],
                ],
                [
                    'name' => 'Paket Bima',
                    'price' => '47.500/pax',
                    'contents' => [
                        'Nasi Putih',
                        'Sambal',
                        'Kerupuk',
                        'Buah Segar',
                        'Snack 2 Macam',
                        'Teh/Kopi',
                        'Es Campur',
                        'Angsio Tahu',
                        'Sop Telur Puyuh',
                        'Ayam Saos Mentega',
                    ],
                ],
                [
                    'name' => 'Paket Arjuna',
                    'price' => '42.500/pax',
                    'contents' => [
                        'Nasi Putih',
                        'Sambal',
                        'Kerupuk',
                        'Buah Segar',
                        'Snack 1 Macam',
                        'Teh/Kopi',
                        'Sop Ayam Jamur',
                        'Ikan Asam Manis',
                        'Sapo Tahu',
                    ],
                ],
            ],
        ],
        [
            'id' => 'nasi-box',
            'name' => 'Paket Nasi Box',
            'type' => 'package-list',
            'items' => [
                [
                    'name' => 'Box Hemat',
                    'price' => '25.000',
                    'contents' => ['Nasi Putih', 'Ayam Goreng/Bakar/Broiler', 'Mie Goreng', 'Kerupuk', 'Sambal'],
                ],
                [
                    'name' => 'Box Premium',
                    'price' => '30.000',
                    'contents' => [
                        'Nasi Putih',
                        'Ayam Goreng Kampoeng',
                        'Mie Goreng',
                        'Sambel Goreng Kentang',
                        'Kerupuk',
                        'Sambal',
                        'Air Mineral',
                    ],
                ],
                [
                    'name' => 'Box Sultan',
                    'price' => '37.500',
                    'contents' => [
                        'Nasi Putih',
                        'Daging Lapis',
                        'Sambel Goreng Kentang',
                        'Kerupuk',
                        'Sambal',
                        'Air Mineral',
                    ],
                ],
            ],
        ],
        [
            'id' => 'ndaging',
            'name' => 'Ndaging & Seafood',
            'type' => 'grid-photo', // Tampilan Grid Standard
            'items' => [
                [
                    'name' => 'Ayam Kampoeng Goreng Laos',
                    'price' => '27.000',
                    'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec',
                ],
                [
                    'name' => 'Bebek Bakar Kecap',
                    'price' => '30.000',
                    'image' => 'https://images.unsplash.com/photo-1596450523098-9994c6575196',
                ],
                [
                    'name' => 'Cumi Crispy',
                    'price' => '30.000',
                    'image' => 'https://images.unsplash.com/photo-1599488615731-7e5c2823528c',
                ],
                [
                    'name' => 'Udang Saus Padang',
                    'price' => '30.000',
                    'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641',
                ],
                [
                    'name' => 'Beef Steak Original',
                    'price' => '45.000',
                    'image' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e',
                ],
            ],
        ],
        [
            'id' => 'minuman',
            'name' => 'Ngadem & Nganget',
            'type' => 'grid-photo-small', // Tampilan Grid Kecil tanpa deskripsi panjang
            'items' => [
                [
                    'name' => 'Es Teh',
                    'price' => '6.000',
                    'image' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc',
                ],
                [
                    'name' => 'Es Teler',
                    'price' => '17.000',
                    'image' => 'https://images.unsplash.com/photo-1563583271-9c1044432c28',
                ],
                [
                    'name' => 'Jus Alpukat',
                    'price' => '15.000',
                    'image' => 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a',
                ],
                [
                    'name' => 'Wedang Uwuh',
                    'price' => '10.000',
                    'image' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9',
                ],
                [
                    'name' => 'Kopi Tubruk',
                    'price' => '5.000',
                    'image' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf',
                ],
            ],
        ],
        [
            'id' => 'snack',
            'name' => 'Menu Snack',
            'type' => 'price-group', // Grouping by Price
            'groups' => [
                [
                    'price' => '2.000',
                    'items' => ['Buah Jeruk', 'Buah Salak', 'Kacang Telur', 'Kacang Oven', 'Buah Pisang'],
                ],
                [
                    'price' => '2.500',
                    'items' => [
                        'Lumpia Sayur',
                        'Pukis',
                        'Dadar Gulung Polos',
                        'Bolu Lapis',
                        'Lumpia Rebung',
                        'Piscok',
                        'Martabak Mini',
                        'Pastel Sayur',
                    ],
                ],
                [
                    'price' => '3.000',
                    'items' => [
                        'Lumpia Ayam',
                        'Lumpia Telur',
                        'Bronis Mini',
                        'Lemper',
                        'Bikang',
                        'Bolu Gulung',
                        'Donat Bobolon',
                    ],
                ],
            ],
        ],
    ];
@endphp

@section('content')
    <div class="relative bg-zinc-900 h-[40vh] flex items-center justify-center overflow-hidden">
        <div
            class="absolute inset-0 opacity-40 bg-[url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1500')] bg-cover bg-center">
        </div>
        <div class="absolute inset-0 bg-linear-to-t from-zinc-50 via-transparent to-black/60"></div>

        <div class="relative z-10 text-center px-4 mt-16">
            <h1 class="font-heritage text-5xl md:text-7xl text-white font-bold mb-4 drop-shadow-lg">
                Buku Menu
            </h1>
            <p class="text-zinc-200 text-lg font-modern tracking-wider">
                Dam Cokro Resto • Heritage Flavors
            </p>
        </div>
    </div>

    <div class="sticky top-20 md:top-24 z-40 bg-white/90 backdrop-blur-md border-b border-zinc-200 shadow-sm transition-all duration-300"
        id="categoryNav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 overflow-x-auto hide-scroll py-4">
                @foreach ($categories as $index => $cat)
                    <a href="#{{ $cat['id'] }}"
                        class="nav-link whitespace-nowrap px-5 py-2 rounded-full border border-zinc-200 text-zinc-600 font-bold text-sm transition hover:border-heritage-red hover:text-heritage-red {{ $index === 0 ? 'active' : '' }}">
                        {{ $cat['name'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-zinc-50 min-h-screen pb-32 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">

            @foreach ($categories as $category)
                <section id="{{ $category['id'] }}" class="scroll-mt-32 reveal">

                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-10 w-2 bg-heritage-red rounded-full"></div>
                        <h2 class="font-heritage text-4xl text-forest-green font-bold">
                            {{ $category['name'] }}
                        </h2>
                    </div>

                    {{-- A. TIPE GRID PROMO (Card Besar) --}}
                    @if ($category['type'] == 'grid-promo')
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($category['items'] as $item)
                                <div
                                    class="bg-white rounded-2xl overflow-hidden shadow-lg border border-golden-cokro transform hover:-translate-y-1 transition duration-300">
                                    <div class="h-48 overflow-hidden relative">
                                        <div
                                            class="absolute top-4 right-4 bg-heritage-red text-white text-xs font-bold px-3 py-1 rounded-full z-10">
                                            BEST DEAL
                                        </div>
                                        <img src="{{ $item['image'] }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-6">
                                        <h3 class="font-heritage text-2xl font-bold text-zinc-800 mb-2">{{ $item['name'] }}
                                        </h3>
                                        <p class="text-zinc-500 text-sm mb-4 h-10">{{ $item['desc'] }}</p>
                                        <div
                                            class="flex justify-between items-center border-t border-dashed border-zinc-200 pt-4">
                                            <span class="text-heritage-red font-bold text-xl">Rp {{ $item['price'] }}</span>
                                            <button
                                                class="bg-forest-green text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-green-700 transition">+</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- B. TIPE PACKAGE LIST (Prasmanan & Nasi Box) --}}
                    @elseif($category['type'] == 'package-list')
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($category['items'] as $item)
                                <div
                                    class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden relative group hover:shadow-md transition">
                                    <div class="bg-forest-green p-4 text-white relative overflow-hidden">
                                        <div class="absolute -right-4 -top-4 w-16 h-16 bg-white/10 rounded-full"></div>
                                        <h3 class="font-heritage text-xl font-bold">{{ $item['name'] }}</h3>
                                        <p class="text-golden-cokro font-bold mt-1">{{ $item['price'] }}</p>
                                    </div>
                                    <div class="p-6">
                                        <ul class="space-y-2">
                                            @foreach ($item['contents'] as $content)
                                                <li class="flex items-start text-sm text-zinc-700">
                                                    <svg class="w-4 h-4 text-heritage-red mr-2 mt-0.5 flex-shrink-0"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    {{ $content }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="h-2 w-full bg-golden-cokro"></div>
                                </div>
                            @endforeach
                        </div>

                        {{-- C. TIPE GRID PHOTO (Standard Ala Carte) --}}
                    @elseif($category['type'] == 'grid-photo')
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($category['items'] as $item)
                                <div
                                    class="bg-white rounded-xl shadow-sm hover:shadow-md transition border border-zinc-100 overflow-hidden group">
                                    <div class="h-40 overflow-hidden relative">
                                        <img src="{{ $item['image'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <div class="p-4">
                                        <h3
                                            class="font-bold text-zinc-800 text-sm md:text-base leading-tight mb-2 min-h-[40px]">
                                            {{ $item['name'] }}</h3>
                                        <p class="text-heritage-red font-bold text-sm">Rp {{ $item['price'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- D. TIPE GRID PHOTO SMALL (Drinks) --}}
                    @elseif($category['type'] == 'grid-photo-small')
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                            @foreach ($category['items'] as $item)
                                <div
                                    class="bg-white rounded-lg p-3 shadow-sm border border-zinc-100 hover:border-forest-green transition flex flex-col items-center text-center">
                                    <img src="{{ $item['image'] }}"
                                        class="w-20 h-20 rounded-full object-cover mb-3 bg-zinc-100">
                                    <h3 class="font-bold text-zinc-800 text-sm leading-tight mb-1">{{ $item['name'] }}</h3>
                                    <p class="text-heritage-red font-bold text-xs">Rp {{ $item['price'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        {{-- E. TIPE PRICE GROUP (Snacks) --}}
                    @elseif($category['type'] == 'price-group')
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($category['groups'] as $group)
                                <div class="border-2 border-dashed border-zinc-300 rounded-2xl bg-[#FFF8E1] p-6 relative">
                                    <div
                                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-zinc-900 text-golden-cokro font-bold px-6 py-2 rounded-full shadow-lg border-2 border-white text-lg">
                                        Serba Rp {{ $group['price'] }}
                                    </div>

                                    <div class="mt-6">
                                        <ul class="grid grid-cols-1 gap-2 text-center">
                                            @foreach ($group['items'] as $snack)
                                                <li
                                                    class="py-2 border-b border-zinc-200 text-zinc-700 font-bold font-modern last:border-0 hover:text-heritage-red transition cursor-default">
                                                    {{ $snack }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </section>
            @endforeach

        </div>
    </div>

    <div class="fixed bottom-6 right-6 md:hidden z-50">
        <a href="{{ route('reservation.form') }}"
            class="bg-golden-cokro text-zinc-900 font-bold px-6 py-3 rounded-full shadow-2xl border-2 border-white flex items-center gap-2 animate-bounce">
            <span>Pesan Sekarang</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>
@endsection

@section('script')
    <script>
        // SCROLL SPY LOGIC FOR STICKY NAV
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');
        const navContainer = document.querySelector('#categoryNav .flex');

        window.addEventListener('scroll', () => {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                // Adjustment offset 180px for sticky header height
                if (pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active', 'bg-heritage-red', 'text-white', 'border-heritage-red');
                link.classList.add('text-zinc-600', 'border-zinc-200'); // Reset style

                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active'); // CSS class will handle styles

                    // Auto Scroll Horizontal Nav to active item
                    link.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }
            });
        });

        // REVEAL ANIMATION (Re-used)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
@endsection
