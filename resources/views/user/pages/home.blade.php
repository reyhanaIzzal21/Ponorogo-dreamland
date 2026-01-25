@extends('user.layouts.app')

@section('content')
    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden">
        <div id="hero-carousel" class="absolute inset-0 z-0">
            <div class="hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-100"
                style="background-image: url('https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=2070&auto=format&fit=crop');">
            </div>
            <div class="hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0"
                style="background-image: url('https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=2070&auto=format&fit=crop');">
            </div>
            <div class="absolute inset-0 bg-linear-to-b from-black/40 via-black/20 to-black/60"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto reveal active">
            <span
                class="inline-block py-1 px-3 rounded-full bg-secondary/90 text-earth text-sm font-bold tracking-wider mb-4 uppercase shadow-lg">Welcome
                to Ponorogo</span>
            <h1 class="font-serif text-4xl md:text-6xl lg:text-7xl text-white font-bold leading-tight mb-6 text-shadow">
                Destinasi Terpadu untuk <br /><span class="text-secondary italic">Kuliner, Tradisi & Rekreasi</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto font-light">
                Nikmati pengalaman tak terlupakan bersama keluarga di pusat kenyamanan dan kehangatan kota Ponorogo.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#destinations"
                    class="bg-secondary text-earth font-bold px-8 py-4 rounded-full shadow-[0_0_20px_rgba(255,235,59,0.5)] hover:bg-yellow-300 transition transform hover:scale-105">
                    Eksplor Sekarang
                </a>
                <a href="#reservation"
                    class="border-2 border-white text-white font-bold px-8 py-4 rounded-full hover:bg-white hover:text-primary transition">
                    Reservasi Tempat
                </a>
            </div>
        </div>
    </section>

    <section id="destinations" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="font-serif text-3xl md:text-4xl text-primary font-bold mb-4">Pilihan Destinasi Kami</h2>
                <p class="text-earth text-lg max-w-2xl mx-auto">Tiga pengalaman berbeda dalam satu kawasan yang
                    harmonis.</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                @forelse($destinations as $index => $destination)
                    @if ($destination->isOpen())
                        {{-- Active/Open Destination Card --}}
                        <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition duration-300 reveal border border-gray-100"
                            style="transition-delay: {{ $index * 150 }}ms;">
                            <div class="h-64 overflow-hidden relative">
                                <img src="{{ $destination->cover_image_url ?? 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1000&auto=format&fit=crop' }}"
                                    alt="{{ $destination->name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                                <div
                                    class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">
                                    {{ $destination->type_label }}</div>
                            </div>
                            <div class="p-8">
                                <h3
                                    class="font-serif text-2xl font-bold text-gray-800 mb-3 group-hover:text-primary transition">
                                    {{ $destination->name }}</h3>
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    {{ $destination->description ?? 'Deskripsi tidak tersedia.' }}</p>
                                <a href="{{ route('reservation') }}"
                                    class="inline-flex items-center text-primary font-bold hover:text-green-800 group-hover:translate-x-2 transition">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Coming Soon / Disabled Destination Card --}}
                        <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition duration-300 reveal border border-gray-100 relative"
                            style="transition-delay: {{ $index * 150 }}ms;">
                            <div
                                class="absolute inset-0 bg-gray-900/60 z-20 flex items-center justify-center backdrop-blur-[2px]">
                                <div
                                    class="bg-secondary text-earth font-bold text-lg px-6 py-2 rounded-full shadow-lg transform -rotate-6 border-2 border-white">
                                    {{ strtoupper($destination->status_label) }}
                                </div>
                            </div>

                            <div class="h-64 overflow-hidden relative grayscale">
                                <img src="{{ $destination->cover_image_url ?? 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=1000&auto=format&fit=crop' }}"
                                    alt="{{ $destination->name }}" class="w-full h-full object-cover">
                                <div
                                    class="absolute top-4 left-4 bg-accent text-white text-xs font-bold px-3 py-1 rounded-full z-10">
                                    {{ $destination->type_label }}</div>
                            </div>
                            <div class="p-8 opacity-60">
                                <h3 class="font-serif text-2xl font-bold text-gray-800 mb-3">{{ $destination->name }}</h3>
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    {{ $destination->description ?? 'Deskripsi tidak tersedia.' }}</p>
                                <span class="inline-flex items-center text-gray-500 font-bold cursor-not-allowed">
                                    Segera Hadir
                                </span>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Belum ada destinasi yang tersedia.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <section id="about" class="py-24 bg-light overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 relative reveal">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-secondary rounded-full opacity-50 blur-xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-primary rounded-full opacity-30 blur-xl">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <img src="https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=800&auto=format&fit=crop"
                            class="rounded-2xl shadow-lg w-full h-64 object-cover mt-8 transform hover:-translate-y-2 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=800&auto=format&fit=crop"
                            class="rounded-2xl shadow-lg w-full h-64 object-cover transform hover:-translate-y-2 transition duration-500">
                    </div>
                </div>

                <div class="lg:w-1/2 reveal">
                    <h4 class="text-primary font-bold tracking-widest uppercase text-sm mb-2">Tentang Kami</h4>
                    <h2 class="font-serif text-4xl font-bold text-gray-900 mb-6">Mewujudkan "Dreamland" di Tanah
                        Ponorogo</h2>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        <span class="font-bold text-earth">Ponorogo Dreamland</span> lahir dari sebuah mimpi sederhana:
                        menyediakan satu tempat di mana tradisi lokal dapat berpadu harmonis dengan kenyamanan modern.
                    </p>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Kami percaya bahwa momen terbaik diciptakan melalui makanan yang lezat, suasana yang hangat, dan
                        tempat yang nyaman. Baik Anda ingin menikmati hidangan di <span
                            class="text-primary font-semibold">Dam Cokro</span> atau merayakan cinta di <span
                            class="text-earth font-semibold">Pendopo</span>, kami hadir untuk melayani.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-4">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/men/85.jpg" alt="">
                        </div>
                        <p class="text-sm text-gray-500 font-medium">Bergabung dengan 1000+ pengunjung bahagia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="text-center p-6 border border-green-600 rounded-xl bg-green-800/30 hover:bg-green-800/50 transition reveal">
                    <div
                        class="w-14 h-14 bg-secondary text-primary rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-lg">
                        📍</div>
                    <h3 class="font-bold text-xl mb-2">Lokasi Strategis</h3>
                    <p class="text-green-100 text-sm">Mudah dijangkau, tepat di jantung aktivitas dan kenyamanan.</p>
                </div>
                <div class="text-center p-6 border border-green-600 rounded-xl bg-green-800/30 hover:bg-green-800/50 transition reveal"
                    style="transition-delay: 100ms;">
                    <div
                        class="w-14 h-14 bg-secondary text-primary rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-lg">
                        ✨</div>
                    <h3 class="font-bold text-xl mb-2">Fasilitas Lengkap</h3>
                    <p class="text-green-100 text-sm">One-stop destination: Makan, Acara, dan Hiburan keluarga.</p>
                </div>
                <div class="text-center p-6 border border-green-600 rounded-xl bg-green-800/30 hover:bg-green-800/50 transition reveal"
                    style="transition-delay: 200ms;">
                    <div
                        class="w-14 h-14 bg-secondary text-primary rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-lg">
                        🤝</div>
                    <h3 class="font-bold text-xl mb-2">Pelayanan Ramah</h3>
                    <p class="text-green-100 text-sm">Keramahan khas Ponorogo dengan standar layanan profesional.</p>
                </div>
                <div class="text-center p-6 border border-green-600 rounded-xl bg-green-800/30 hover:bg-green-800/50 transition reveal"
                    style="transition-delay: 300ms;">
                    <div
                        class="w-14 h-14 bg-secondary text-primary rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-lg">
                        🏛️</div>
                    <h3 class="font-bold text-xl mb-2">Suasana Otentik</h3>
                    <p class="text-green-100 text-sm">Perpaduan desain modern dan sentuhan tradisional Jawa.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="font-serif text-3xl md:text-4xl text-gray-900 font-bold mb-4">Momen di Dreamland</h2>
                <p class="text-gray-500">Lihat bagaimana pengunjung kami menikmati waktunya.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-[600px] reveal">
                <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-2xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1000&auto=format&fit=crop"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <p class="text-white font-serif text-xl">"Wedding di Pendopo sangat magis!" - Siti A.</p>
                    </div>
                </div>
                <div class="md:col-span-1 md:row-span-1 relative group overflow-hidden rounded-2xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=800&auto=format&fit=crop"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white font-bold">Menu Favorit</span>
                    </div>
                </div>
                <div
                    class="md:col-span-1 md:row-span-1 relative group overflow-hidden rounded-2xl cursor-pointer bg-earth flex items-center justify-center text-center p-4">
                    <blockquote class="text-white italic font-serif">
                        "Tempat paling nyaman di Ponorogo saat ini. Makanannya juara!"
                        <footer class="text-sm mt-2 text-secondary not-italic font-sans">- Budi Santoso</footer>
                    </blockquote>
                </div>
                <div class="md:col-span-2 md:row-span-1 relative group overflow-hidden rounded-2xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=1000&auto=format&fit=crop"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <p class="text-white font-medium">Suasana malam yang syahdu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="reservation" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-earth">
            <div class="absolute inset-0 opacity-20"
                style="background-image: radial-gradient(#FFEB3B 1px, transparent 1px); background-size: 30px 30px;">
            </div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 reveal">
            <h2 class="font-serif text-4xl md:text-5xl text-white font-bold mb-6">Siap Membuat Kenangan?</h2>
            <p class="text-white/80 text-xl mb-10">Entah itu makan siang santai atau resepsi pernikahan impian, kami
                siap menyambut Anda.</p>

            <div class="bg-white p-2 rounded-full inline-flex flex-col sm:flex-row gap-2 shadow-2xl">
                <input type="text" placeholder="Tanggal Rencana?"
                    class="px-6 py-3 rounded-full outline-none text-gray-700 focus:ring-2 focus:ring-primary w-full sm:w-64">
                <button
                    class="bg-primary hover:bg-green-800 text-white font-bold px-8 py-3 rounded-full transition shadow-md w-full sm:w-auto">
                    Pesan Tempat Sekarang
                </button>
            </div>
            <p class="mt-4 text-white/60 text-sm">Atau hubungi kami via WhatsApp untuk respon cepat. <br>
                <a href="https://wa.me/628123456789" class="text-md text-white underline font-bold">Contact Us</a>
            </p>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // HERO SLIDER LOGIC
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        function nextSlide() {
            // Hilangkan opacity slide saat ini
            slides[currentSlide].style.opacity = '0';
            // Pindah index
            currentSlide = (currentSlide + 1) % slides.length;
            // Munculkan slide baru
            slides[currentSlide].style.opacity = '1';
        }

        // Ganti slide setiap 5 detik
        setInterval(nextSlide, 5000);

        // SCROLL REVEAL ANIMATION (Intersection Observer)
        const revealElements = document.querySelectorAll('.reveal');

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target); // Hanya animasi sekali
                }
            });
        }, {
            root: null,
            threshold: 0.15, // Muncul ketika 15% elemen terlihat
        });

        revealElements.forEach(el => revealObserver.observe(el));
    </script>
@endsection
