@extends('user.layouts.app')

@section('style')
    <style>
        /* 1. CUSTOM ANIMATIONS FOR "WATER" VIBE */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        /* 2. GLASSMORPHISM UTILITY */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        /* 3. BACKGROUND GRADIENT FLUID */
        .bg-water-gradient {
            background: radial-gradient(circle at top left, var(--color-accent) 0%, transparent 40%),
                radial-gradient(circle at bottom right, var(--color-accent) 0%, transparent 40%),
                var(--color-zinc-900);
            /* Dark base for pop */
        }

        /* Countdown Box Style */
        .countdown-box {
            background: rgba(2, 136, 209, 0.2);
            /* Waterfall Blue Low Opacity */
            border: 1px solid var(--color-accent);
        }
    </style>
@endsection

@section('content')
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-water-gradient">

        <div class="absolute top-20 left-10 w-64 h-64 bg-accent/30 rounded-full blur-3xl floating-element"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-primary/20 rounded-full blur-3xl floating-element"
            style="animation-delay: -2s;"></div>

        <div class="absolute inset-0 z-0">
            <img src="{{ isset($content->teaser_background) ? asset('storage/' . $content->teaser_background) : 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=2000&auto=format&fit=crop' }}"
                class="w-full h-full object-cover opacity-40 mix-blend-overlay">
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
            <span
                class="inline-block py-2 px-6 rounded-full bg-accent/20 border border-accent text-accent font-bold tracking-widest text-sm mb-6 animate-pulse">
                {{ $content->badge_text ?? 'COMING SOON 2026' }}
            </span>

            <h1 class="font-modern text-5xl md:text-7xl text-white font-bold mb-6 leading-tight drop-shadow-2xl">
                {{ $content->main_headline ?? 'The New ' }} <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-cyan-300">{{ $content->blue_headline ?? 'Oasis in Town' }}</span>
            </h1>
            <p class="font-sans text-xl text-zinc-300 mb-10 max-w-2xl mx-auto font-light">
                {{ $content->sub_headline ?? 'Segarkan hari Anda di destinasi terbaru Ponorogo. Perpaduan kesejukan air dan estetika modern yang belum pernah Anda temui sebelumnya.' }}
            </p>

            <div class="grid grid-cols-4 gap-4 max-w-2xl mx-auto mb-12">
                <div class="glass-card p-4 rounded-xl text-center">
                    <span id="days" class="block text-4xl font-bold text-white font-modern">00</span>
                    <span class="text-xs text-zinc-400 uppercase tracking-wider">Hari</span>
                </div>
                <div class="glass-card p-4 rounded-xl text-center">
                    <span id="hours" class="block text-4xl font-bold text-white font-modern">00</span>
                    <span class="text-xs text-zinc-400 uppercase tracking-wider">Jam</span>
                </div>
                <div class="glass-card p-4 rounded-xl text-center">
                    <span id="minutes" class="block text-4xl font-bold text-white font-modern">00</span>
                    <span class="text-xs text-zinc-400 uppercase tracking-wider">Menit</span>
                </div>
                <div class="glass-card p-4 rounded-xl text-center">
                    <span id="seconds" class="block text-4xl font-bold text-secondary font-modern">00</span>
                    <span class="text-xs text-zinc-400 uppercase tracking-wider">Detik</span>
                </div>
            </div>

            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </div>
        </div>
    </section>

    <section class="py-24 bg-zinc-950 text-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="font-modern text-3xl md:text-4xl font-bold mb-4">Sneak Peek Experience</h2>
                <p class="text-zinc-400">Apa yang akan Anda temukan di Ponorogo Dreamland Pool?</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 h-auto md:h-[600px] reveal">

                @php
                    $slot1 = $sneakPeeks->where('slot_number', 1)->first();
                    $slot2 = $sneakPeeks->where('slot_number', 2)->first();
                    $slot3 = $sneakPeeks->where('slot_number', 3)->first();
                    $slot4 = $sneakPeeks->where('slot_number', 4)->first();
                @endphp

                {{-- SLOT 1 --}}
                <div
                    class="md:col-span-2 md:row-span-2 glass-card rounded-2xl overflow-hidden relative group hover:border-accent/50 transition duration-500">
                    <img src="{{ isset($slot1->image_path) ? asset('storage/' . $slot1->image_path) : 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?q=80&w=1000&auto=format&fit=crop' }}"
                        class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition duration-700">
                    <div class="absolute bottom-0 left-0 p-8 w-full bg-gradient-to-t from-black to-transparent">
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $slot1->title ?? 'Family & Kids Friendly' }}</h3>
                        <p class="text-zinc-300 text-sm">
                            {{ $slot1->description ?? 'Wahana air yang aman dengan kedalaman bertingkat, dirancang khusus untuk keceriaan keluarga kecil Anda.' }}
                        </p>
                    </div>
                </div>

                {{-- SLOT 2 --}}
                <div
                    class="md:col-span-1 md:row-span-1 glass-card rounded-2xl p-6 flex flex-col justify-between hover:bg-accent/10 transition group">
                    <div
                        class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center text-accent group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-1">{{ $slot2->title ?? 'Aesthetic Poolside' }}</h3>
                        <p class="text-xs text-zinc-400">
                            {{ $slot2->description ?? 'Spot foto Instagramable di setiap sudut.' }}</p>
                    </div>
                </div>

                {{-- SLOT 3 --}}
                <div class="md:col-span-1 md:row-span-1 glass-card rounded-2xl overflow-hidden relative group">
                    <img src="{{ isset($slot3->image_path) ? asset('storage/' . $slot3->image_path) : 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?q=80&w=500&auto=format&fit=crop' }}"
                        class="w-full h-full object-cover opacity-70">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span
                            class="bg-black/50 backdrop-blur-md px-4 py-2 rounded-full text-sm font-bold border border-white/20">{{ $slot3->title ?? 'Mini Cafe' }}</span>
                    </div>
                </div>

                {{-- SLOT 4 --}}
                <div
                    class="md:col-span-2 md:row-span-1 glass-card rounded-2xl p-8 flex items-center gap-6 hover:border-accent/50 transition">
                    <div class="hidden md:block w-32 h-32 bg-zinc-800 rounded-xl overflow-hidden flex-shrink-0">
                        <img src="{{ isset($slot4->image_path) ? asset('storage/' . $slot4->image_path) : 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?q=80&w=500' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $slot4->title ?? 'Fasilitas Modern & Bersih' }}
                        </h3>
                        <p class="text-zinc-400 text-sm mb-4">
                            {{ $slot4->description ?? 'Ruang ganti premium, shower air hangat, dan locker room dengan keamanan digital.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-zinc-900 relative border-t border-zinc-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center reveal">
                <h2 class="font-modern text-3xl font-bold text-white">Project Timeline</h2>
                <p class="text-zinc-500">Pantau terus perkembangan pembangunan Oasis kami.</p>
            </div>

            <div class="relative pl-8 border-l-2 border-zinc-800 space-y-12 reveal">

                @foreach ($timelineStages as $stage)
                    <div class="relative">
                        @if ($stage->status == 'done')
                            <div
                                class="absolute -left-[41px] bg-accent w-6 h-6 rounded-full border-4 border-zinc-900 flex items-center justify-center">
                                <svg class="w-3 h-3 text-zinc-900 font-bold" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="bg-zinc-800/50 p-6 rounded-xl border border-zinc-700">
                                <h3 class="text-accent font-bold text-lg">{{ $stage->title }}</h3>
                                <p class="text-zinc-400 text-sm mt-1">{{ $stage->period }}</p>
                                <p class="text-zinc-300 text-sm mt-3">{{ $stage->description }}</p>
                            </div>
                        @elseif($stage->status == 'on_progress')
                            <div
                                class="absolute -left-[41px] w-6 h-6 rounded-full border-4 border-zinc-900 bg-secondary animate-pulse shadow-[0_0_15px_rgba(255,235,59,0.5)]">
                            </div>
                            <div
                                class="bg-zinc-800/80 p-6 rounded-xl border border-secondary/30 shadow-[0_0_20px_rgba(255,235,59,0.05)]">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-white font-bold text-lg">{{ $stage->title }}</h3>
                                    <span class="text-xs bg-secondary text-black font-bold px-2 py-0.5 rounded">ON PROGRESS
                                        {{ $stage->progress_percentage }}%</span>
                                </div>
                                <p class="text-zinc-400 text-sm">{{ $stage->period }}</p>
                                <p class="text-zinc-300 text-sm mt-3">{{ $stage->description }}</p>

                                @if ($stage->photos->count() > 0)
                                    <div class="mt-4 grid grid-cols-3 gap-2">
                                        @foreach ($stage->photos as $photo)
                                            <img src="{{ asset('storage/' . $photo->image_path) }}"
                                                class="rounded h-16 w-full object-cover grayscale hover:grayscale-0 transition">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="absolute -left-[41px] bg-zinc-700 w-6 h-6 rounded-full border-4 border-zinc-900">
                            </div>
                            <div class="opacity-50">
                                <h3 class="text-zinc-400 font-bold text-lg">{{ $stage->title }}</h3>
                                <p class="text-zinc-500 text-sm mt-1">{{ $stage->period }}</p>
                                <p class="text-zinc-500 text-sm mt-3">{{ $stage->description }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // 1. COUNTDOWN LOGIC
        // Set tanggal pembukaan
        @if (isset($content->launch_date))
            const openingDate = new Date("{{ $content->launch_date->format('Y-m-d') }}");
        @else
            const openingDate = new Date();
            openingDate.setDate(openingDate.getDate() + 30); // Default 30 hari lagi
        @endif

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = openingDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Add leading zero
            document.getElementById("days").innerText = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;

            if (distance < 0) {
                document.getElementById("days").innerText = "00";
                document.getElementById("hours").innerText = "00";
                document.getElementById("minutes").innerText = "00";
                document.getElementById("seconds").innerText = "00";
            }
        }

        setInterval(updateCountdown, 1000);
        updateCountdown(); // Run immediately

        // 2. FORM INTERACTION (Simple Vue-like transition)
        function handleNotify(e) {
            e.preventDefault();
            const form = document.getElementById('notifyForm');
            const success = document.getElementById('successMessage');
            const btn = form.querySelector('button');

            // Loading state
            btn.innerHTML = 'Menyimpan...';
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            setTimeout(() => {
                form.style.display = 'none';
                success.classList.remove('hidden');
                success.classList.add('animate-fade-in-up'); // From your app.css
            }, 1500);
        }

        // 3. SCROLL REVEAL (Reused logic)
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
