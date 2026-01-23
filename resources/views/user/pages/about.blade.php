@extends('user.layouts.app')

@section('style')
    <style>
        /* 1. ORGANIC SHAPE GENERATOR (CSS Pure) */
        .organic-blob {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            transition: all 1s ease-in-out;
            animation: morph 8s ease-in-out infinite;
        }

        @keyframes morph {
            0% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            }

            50% {
                border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            }

            100% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            }
        }

        /* 2. PARALLAX UTILITY */
        .parallax-element {
            will-change: transform;
        }

        /* 3. BENTO GRID CUSTOM HEIGHTS */
        .bento-card {
            transition: transform 0.3s ease;
        }

        .bento-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection

@section('content')
    <section class="min-h-screen flex flex-col md:flex-row items-center overflow-hidden bg-zinc-50 relative">
        <div
            class="absolute inset-0 opacity-40 bg-[url('https://www.transparenttextures.com/patterns/concrete-wall.png')] mix-blend-multiply pointer-events-none">
        </div>

        <div
            class="w-full md:w-[60%] px-8 md:pl-24 md:pr-12 pt-32 md:pt-0 z-10 flex flex-col justify-center h-full order-2 md:order-1">
            <span class="inline-block text-primary font-bold tracking-[0.2em] uppercase text-sm mb-6 reveal">
                Tentang Kami
            </span>
            <h1 class="font-heritage text-5xl md:text-7xl lg:text-8xl text-zinc-900 font-bold leading-[0.95] mb-8 reveal">
                Lebih dari <br>
                Sekadar <span
                    class="text-transparent bg-clip-text bg-linear-to-r from-primary to-emerald-400">Destinasi.</span>
            </h1>
            <div class="w-24 h-2 bg-secondary mb-8 reveal"></div>
            <p class="font-modern text-lg md:text-xl text-zinc-600 leading-relaxed max-w-xl reveal">
                Ini adalah sebuah mimpi yang menjadi nyata. Ponorogo Dreamland menyatukan cita rasa kuliner, kehangatan
                tradisi, dan keceriaan keluarga dalam satu harmoni.
            </p>
        </div>

        <div
            class="w-full md:w-[40%] h-[50vh] md:h-screen relative flex items-center justify-center order-1 md:order-2 parallax-container">
            <div class="organic-blob w-80 h-80 md:w-[500px] md:h-[500px] overflow-hidden shadow-2xl relative z-20 parallax-element"
                data-speed="0.05">
                <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=1000&auto=format&fit=crop"
                    class="w-full h-full object-cover scale-110" alt="Ponorogo Dreamland Vibe">
            </div>

            <div
                class="absolute top-1/4 right-10 w-32 h-32 bg-secondary rounded-full mix-blend-multiply blur-xl opacity-60 animate-pulse z-10">
            </div>
            <div
                class="absolute bottom-1/4 left-10 w-48 h-48 bg-primary rounded-full mix-blend-multiply blur-2xl opacity-40 z-10">
            </div>
        </div>
    </section>

    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row items-center gap-12 mb-24 reveal">
                <div class="w-full md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=800&auto=format&fit=crop"
                        class="w-full h-[400px] object-cover rounded-[3rem] rounded-tr-none shadow-xl transform hover:scale-[1.02] transition duration-500">
                </div>
                <div class="w-full md:w-1/2 md:pl-10">
                    <span class="text-zinc-400 font-bold text-6xl opacity-20 -ml-4">01</span>
                    <h2 class="font-heritage text-4xl font-bold text-zinc-900 mb-6 -mt-8">Awal Mula Mimpi</h2>
                    <p class="font-modern text-lg text-zinc-600 leading-loose">
                        Berawal dari lahan kosong di jantung kota, kami melihat potensi untuk menciptakan ruang publik yang
                        tidak hanya komersial, tapi juga memanusiakan manusia. Kami ingin warga Ponorogo memiliki tempat di
                        mana mereka bisa bangga akan kotanya.
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-12 mb-24 reveal">
                <div class="w-full md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1464695110811-dcf3903dc2f4?q=80&w=800&auto=format&fit=crop"
                        class="w-full h-[400px] object-cover rounded-[3rem] rounded-tl-none shadow-xl transform hover:scale-[1.02] transition duration-500">
                </div>
                <div class="w-full md:w-1/2 md:pr-10 text-right md:text-left">
                    <div class="flex flex-col md:items-end">
                        <span class="text-zinc-400 font-bold text-6xl opacity-20 -mr-4 md:mr-0 md:-ml-4">02</span>
                        <h2 class="font-heritage text-4xl font-bold text-zinc-900 mb-6 -mt-8">Filosofi "Dreamland"</h2>
                    </div>
                    <p class="font-modern text-lg text-zinc-600 leading-loose">
                        Mengapa "Dreamland"? Karena kami percaya setiap sudut tempat ini dirancang untuk mewujudkan mimpi
                        kecil Anda: mimpi makan enak, mimpi pernikahan indah, hingga mimpi anak-anak bermain air dengan
                        riang.
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-12 reveal">
                <div class="w-full md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=800&auto=format&fit=crop"
                        class="w-full h-[400px] object-cover rounded-[3rem] rounded-br-none shadow-xl transform hover:scale-[1.02] transition duration-500 grayscale hover:grayscale-0">
                </div>
                <div class="w-full md:w-1/2 md:pl-10">
                    <span class="text-zinc-400 font-bold text-6xl opacity-20 -ml-4">03</span>
                    <h2 class="font-heritage text-4xl font-bold text-zinc-900 mb-6 -mt-8">Komitmen Kami</h2>
                    <p class="font-modern text-lg text-zinc-600 leading-loose">
                        Kami tidak hanya membangun gedung, kami membangun komunitas. Komitmen kami adalah memberikan
                        pelayanan setara hotel berbintang namun dengan keramahtamahan khas warga lokal Ponorogo.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="py-24 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="font-heritage text-4xl text-zinc-900 font-bold">Nilai Inti Kami</h2>
                <div class="w-24 h-1 bg-zinc-200 mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 grid-rows-2 gap-6 h-auto md:h-[500px] reveal">

                <div
                    class="md:col-span-1 md:row-span-2 bento-card bg-white p-8 rounded-3xl shadow-sm border-t-8 border-primary relative overflow-hidden group">
                    <div
                        class="absolute right-0 bottom-0 w-32 h-32 bg-primary/10 rounded-tl-full transition group-hover:scale-150">
                    </div>
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div
                            class="w-16 h-16 bg-primary/20 text-primary rounded-2xl flex items-center justify-center text-3xl mb-6">
                            🏛️</div>
                        <div>
                            <h3 class="font-heritage text-3xl font-bold text-zinc-800 mb-4">Otentik</h3>
                            <p class="text-zinc-500 leading-relaxed">
                                Menjaga resep warisan leluhur dan arsitektur asli. Kami tidak mengubah tradisi, kami hanya
                                memolesnya agar lebih bersinar.
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="md:col-span-2 md:row-span-1 bento-card bg-white p-8 rounded-3xl shadow-sm border-l-8 border-accent relative overflow-hidden group flex items-center">
                    <div class="absolute right-0 top-0 w-full h-full bg-accent/5 transition group-hover:bg-accent/10"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-6">
                        <div
                            class="w-16 h-16 bg-accent/20 text-accent rounded-2xl flex items-center justify-center text-3xl shrink-0">
                            🚀</div>
                        <div>
                            <h3 class="font-heritage text-2xl font-bold text-zinc-800 mb-2">Inovatif</h3>
                            <p class="text-zinc-500 leading-relaxed">
                                Terus berkembang dengan fasilitas modern seperti sistem reservasi digital dan wahana kolam
                                renang futuristik.
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="md:col-span-2 md:row-span-1 bento-card bg-zinc-900 p-8 rounded-3xl shadow-lg border-b-8 border-secondary relative overflow-hidden group flex items-center">
                    <div class="absolute inset-0 z-0">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800"
                            class="w-full h-full object-cover opacity-20 group-hover:opacity-30 transition">
                    </div>
                    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-6 w-full">
                        <div
                            class="w-16 h-16 bg-secondary text-zinc-900 rounded-2xl flex items-center justify-center text-3xl shrink-0 shadow-[0_0_15px_rgba(255,235,59,0.5)]">
                            🤝</div>
                        <div>
                            <h3 class="font-heritage text-2xl font-bold text-white mb-2">Kehangatan Keluarga</h3>
                            <p class="text-zinc-300 leading-relaxed">
                                Pelayanan yang membuat Anda merasa seperti pulang ke rumah sendiri. Senyum kami adalah
                                standar kami.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-20 bg-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-green-700/50 reveal">

                <div class="p-4">
                    <div class="text-secondary text-5xl font-bold font-modern mb-2 flex justify-center items-center">
                        <span class="counter" data-target="3">0</span>
                    </div>
                    <p class="uppercase tracking-widest text-sm text-green-100 font-semibold">Unit Bisnis Utama</p>
                </div>

                <div class="p-4">
                    <div class="text-secondary text-5xl font-bold font-modern mb-2 flex justify-center items-center">
                        <span class="counter" data-target="1000">0</span>+
                    </div>
                    <p class="uppercase tracking-widest text-sm text-green-100 font-semibold">Pengunjung Bahagia</p>
                </div>

                <div class="p-4">
                    <div class="text-secondary text-5xl font-bold font-modern mb-2 flex justify-center items-center">
                        <span class="counter" data-target="100">0</span>%
                    </div>
                    <p class="uppercase tracking-widest text-sm text-green-100 font-semibold">Lokal Ponorogo</p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-32 bg-forest-green relative overflow-hidden flex items-center justify-center">
        <svg class="absolute bottom-0 left-0 w-full h-full opacity-10 pointer-events-none" viewBox="0 0 100 100"
            preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="none" stroke="white" stroke-width="0.5" />
            <path d="M0 100 C 30 20 70 20 100 100 Z" fill="none" stroke="white" stroke-width="0.5"
                style="animation: float 5s infinite" />
        </svg>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 reveal">
            <div class="text-6xl text-secondary opacity-50 font-serif mb-6">“</div>
            <h2 class="font-heritage text-3xl md:text-5xl text-white font-bold leading-tight mb-10">
                Kami ingin menciptakan tempat di mana teknologi dan tradisi tidak saling bertentangan, melainkan saling
                melengkapi untuk menciptakan kenangan.
            </h2>

            <div class="flex items-center justify-center gap-4">
                <div class="w-12 h-1 bg-secondary rounded-full"></div>
                <div class="text-left">
                    <p class="text-white font-bold uppercase tracking-widest text-sm">Founder</p>
                    <p class="text-zinc-300 text-xs">Ponorogo Dreamland</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // 1. SCROLL REVEAL (Standard)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.reveal').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s ease-out';
            observer.observe(el);
        });

        // 2. PARALLAX EFFECT FOR HERO IMAGE
        const parallaxEl = document.querySelector('.parallax-element');

        if (parallaxEl) {
            window.addEventListener('scroll', () => {
                const scrollY = window.scrollY;
                const speed = parallaxEl.getAttribute('data-speed');
                // Move opposite direction of scroll for "floating" feel or same for "depth"
                parallaxEl.style.transform = `translateY(${scrollY * speed * 100}px)`;
            });
        }

        // 3. NUMBER COUNTER ANIMATION
        const counters = document.querySelectorAll('.counter');
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute('data-target');
                    const speed = 200; // The lower the slower

                    const updateCount = () => {
                        const count = +counter.innerText;
                        const inc = target / speed;

                        if (count < target) {
                            counter.innerText = Math.ceil(count + inc);
                            setTimeout(updateCount, 20);
                        } else {
                            counter.innerText = target;
                        }
                    };

                    updateCount();
                    observer.unobserve(counter);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(counter => {
            counterObserver.observe(counter);
        });
    </script>
@endsection
