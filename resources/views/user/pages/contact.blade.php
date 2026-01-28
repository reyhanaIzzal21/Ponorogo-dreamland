@extends('user.layouts.app')

@section('style')
    <style>
        /* Social Card Gradients & Hover Effects */
        .card-wa {
            background: linear-gradient(135deg, #DCFCE7 0%, #ffffff 100%);
            border: 1px solid #BBF7D0;
        }

        .card-wa:hover {
            border-color: #25D366;
            box-shadow: 0 10px 20px -5px rgba(37, 211, 102, 0.2);
        }

        .card-ig {
            background: linear-gradient(135deg, #FFF1F2 0%, #ffffff 100%);
            border: 1px solid #FECDD3;
        }

        .card-ig:hover {
            border-color: #E1306C;
            box-shadow: 0 10px 20px -5px rgba(225, 48, 108, 0.2);
        }

        .card-tt {
            background: linear-gradient(135deg, #F3F4F6 0%, #ffffff 100%);
            border: 1px solid #E5E7EB;
        }

        .card-tt:hover {
            border-color: #000000;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.2);
        }

        /* Map Container Styling */
        .map-frame iframe {
            width: 100%;
            height: 100%;
            filter: grayscale(20%) contrast(1.2) opacity(0.9);
            transition: all 0.5s ease;
        }

        .map-frame:hover iframe {
            filter: none;
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <section class="pt-32 pb-16 bg-zinc-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-48 h-48 bg-secondary/10 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 reveal active">
            <span
                class="inline-block py-1 px-4 border border-primary/30 text-primary bg-primary/5 rounded-full text-xs font-bold tracking-widest uppercase mb-4">
                Get In Touch
            </span>
            <h1 class="font-heritage text-4xl md:text-6xl text-zinc-900 font-bold mb-6">
                Kami Siap Menyambut Anda
            </h1>
            <p class="font-modern text-lg text-zinc-500 max-w-2xl mx-auto leading-relaxed">
                Punya pertanyaan seputar reservasi, menu, atau lokasi? Hubungi kami melalui kanal favorit Anda di bawah ini.
            </p>
        </div>
    </section>

    <section class="py-12 bg-white relative z-20 mt-8 rounded-t-[3rem]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 -mt-20">

                <a href="https://wa.me/{{ $contact->whatsapp_number }}" target="_blank"
                    class="card-wa p-8 rounded-2xl transition transform hover:-translate-y-2 group flex flex-col items-center text-center shadow-lg relative bg-white">
                    <div
                        class="w-16 h-16 bg-[#25D366]/10 text-[#25D366] rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-zinc-800 mb-2">WhatsApp</h3>
                    <p class="text-zinc-500 text-sm mb-4">Respon cepat untuk reservasi & info mendesak.</p>
                    <span
                        class="text-[#25D366] font-bold text-sm border-b-2 border-[#25D366]/30 pb-1 group-hover:border-[#25D366]">Chat
                        Admin &rarr;</span>
                </a>

                <a href="{{ $contact->instagram_url }}" target="_blank"
                    class="card-ig p-8 rounded-2xl transition transform hover:-translate-y-2 group flex flex-col items-center text-center shadow-lg relative bg-white">
                    <div
                        class="w-16 h-16 bg-pink-50 text-[#E1306C] rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-zinc-800 mb-2">Instagram</h3>
                    <p class="text-zinc-500 text-sm mb-4">Galeri foto estetik, promo terbaru, dan stories harian.</p>
                    <span
                        class="text-[#E1306C] font-bold text-sm border-b-2 border-[#E1306C]/30 pb-1 group-hover:border-[#E1306C]">Follow
                        Us &rarr;</span>
                </a>

                <a href="{{ $contact->tiktok_url }}" target="_blank"
                    class="card-tt p-8 rounded-2xl transition transform hover:-translate-y-2 group flex flex-col items-center text-center shadow-lg relative bg-white">
                    <div
                        class="w-16 h-16 bg-gray-100 text-black rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.35a6.015 6.015 0 0 1 3.99-5.77V.02z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-zinc-800 mb-2">TikTok</h3>
                    <p class="text-zinc-500 text-sm mb-4">Video seru, behind the scenes, dan challenge menarik.</p>
                    <span
                        class="text-black font-bold text-sm border-b-2 border-black/30 pb-1 group-hover:border-black">Watch
                        Videos &rarr;</span>
                </a>

            </div>
        </div>
    </section>

    <section class="py-24 bg-white border-b border-zinc-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 items-center">

                <div class="lg:w-1/3 space-y-8 reveal">
                    <div>
                        <h2 class="font-heritage text-3xl font-bold text-primary mb-4">Lokasi Kami</h2>
                        <p class="text-zinc-600 leading-relaxed">
                            Terletak strategis di jantung kota, Ponorogo Dreamland mudah dijangkau dengan kendaraan pribadi
                            maupun transportasi umum.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center text-earth flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-zinc-800 text-sm uppercase mb-1">Alamat</h4>
                                <p class="text-zinc-600 text-sm">{{ $contact->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-2/3 w-full reveal" style="transition-delay: 200ms;">
                    <div class="map-frame rounded-2xl overflow-hidden shadow-2xl border-4 border-white h-[450px] relative">
                        <iframe src="{{ $contact->maps_embed_url }}" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <a href="https://maps.google.com" target="_blank"
                            class="absolute bottom-6 right-6 bg-white text-zinc-800 px-6 py-3 rounded-full font-bold shadow-lg flex items-center gap-2 hover:bg-primary hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                            </svg>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // Scroll Reveal (Standard)
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
