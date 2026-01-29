@extends('user.layouts.app')

@section('title', 'Buku Menu')

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

        /* Lazy Load Image Animation */
        img[loading="lazy"] {
            opacity: 0;
            transition: opacity 0.3s ease-in;
        }

        img[loading="lazy"].loaded,
        img:not([loading="lazy"]) {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    {{-- Hero Section --}}
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

    {{-- Sticky Category Navigation --}}
    <div class="sticky top-20 md:top-24 z-40 bg-white/90 backdrop-blur-md border-b border-zinc-200 shadow-sm transition-all duration-300"
        id="categoryNav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 overflow-x-auto hide-scroll py-4">
                @foreach ($categories as $index => $cat)
                    <a href="#{{ $cat->slug }}"
                        class="nav-link whitespace-nowrap px-5 py-2 rounded-full border border-zinc-200 text-zinc-600 font-bold text-sm transition hover:border-heritage-red hover:text-heritage-red {{ $index === 0 ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Menu Sections --}}
    <div class="bg-zinc-50 min-h-screen pb-32 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">

            @foreach ($categories as $category)
                <section id="{{ $category->slug }}" class="scroll-mt-32 reveal">

                    {{-- Section Header --}}
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-10 w-2 bg-heritage-red rounded-full"></div>
                        <h2 class="font-heritage text-4xl text-forest-green font-bold">
                            {{ $category->name }}
                        </h2>
                    </div>

                    {{-- Dynamic Layout Based on Category Type --}}
                    @switch($category->type)
                        @case('grid-promo')
                            @include('user.pages.destinations.restaurant.partials.grid-promo', [
                                'category' => $category,
                            ])
                        @break

                        @case('package-list')
                            @include('user.pages.destinations.restaurant.partials.package-list', [
                                'category' => $category,
                            ])
                        @break

                        @case('grid-photo')
                            @include('user.pages.destinations.restaurant.partials.grid-photo', [
                                'category' => $category,
                            ])
                        @break

                        @case('grid-photo-small')
                            @include('user.pages.destinations.restaurant.partials.grid-photo-small', [
                                'category' => $category,
                            ])
                        @break

                        @case('price-group')
                            @include('user.pages.destinations.restaurant.partials.price-group', [
                                'category' => $category,
                            ])
                        @break
                    @endswitch

                </section>
            @endforeach

        </div>
    </div>

    {{-- Mobile CTA Button --}}
    <div class="fixed bottom-6 right-6 md:hidden z-50">
        <a href="{{ route('reservation.form') }}"
            class="bg-golden-cokro text-zinc-900 font-bold px-6 py-3 rounded-full shadow-2xl border-2 border-white flex items-center gap-2 animate-bounce">
            <span>Reservasi Sekarang</span>
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

        // REVEAL ANIMATION
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

        // LAZY LOAD IMAGE ANIMATION
        document.querySelectorAll('img[loading="lazy"]').forEach(img => {
            if (img.complete) {
                img.classList.add('loaded');
            } else {
                img.addEventListener('load', () => {
                    img.classList.add('loaded');
                });
            }
        });
    </script>
@endsection
