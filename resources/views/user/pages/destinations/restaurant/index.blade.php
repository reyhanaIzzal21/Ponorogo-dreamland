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
    <section class="relative h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop"
                alt="Suasana Dam Cokro" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-heritage-red opacity-40 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-black/30"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto fade-up">
            <h1 class="font-heritage text-5xl md:text-7xl text-white font-bold mb-6 drop-shadow-lg leading-tight">
                Cita Rasa Tradisional <br>
                <span class="italic font-light text-golden-cokro">di Jantung Ponorogo</span>
            </h1>
            <p class="font-modern text-lg text-gray-100 mb-10 max-w-2xl mx-auto font-light tracking-wide">
                Nikmati hidangan warisan leluhur dengan sentuhan modern, disajikan dalam kehangatan suasana kekeluargaan.
            </p>

            <a href="#reservation"
                class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-forest-green transition-all duration-200 bg-golden-cokro font-modern rounded-full hover:bg-[#ffcf40] hover:scale-105 shadow-[0_0_20px_rgba(251,192,45,0.4)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-golden-cokro">
                <span>Pesan Meja Sekarang</span>
                <svg class="w-5 h-5 ml-2 -mr-1 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                    </path>
                </svg>
            </a>
        </div>
    </section>

    <section class="py-24 bg-parchment">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-up">
                <h3 class="text-heritage-red font-bold tracking-widest uppercase text-sm mb-2">Pilihan Chef</h3>
                <h2 class="font-heritage text-4xl md:text-5xl text-forest-green font-bold">Menu Andalan Kami</h2>
                <div class="w-24 h-1 bg-golden-cokro mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="group relative bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 fade-up border border-golden-cokro/20">
                    <div class="h-72 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1000&auto=format&fit=crop"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute top-4 right-4 bg-golden-cokro text-black text-xs font-bold px-3 py-2 rounded-lg shadow-md uppercase tracking-wider">
                            ★ Best Seller
                        </div>
                    </div>
                    <div class="p-8 text-center relative">
                        <div
                            class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-parchment rounded-full flex items-center justify-center border border-golden-cokro">
                            <span class="text-xl">🌶️</span>
                        </div>
                        <h3 class="font-heritage text-2xl font-bold text-forest-green mb-2 mt-4">Sate Ponorogo Premium</h3>
                        <p class="text-gray-600 text-sm mb-4 font-modern line-clamp-2">Daging ayam pilihan dengan bumbu
                            kacang resep rahasia keluarga sejak 1980.</p>
                        <p class="font-heritage text-2xl text-heritage-red font-bold">Rp 35.000</p>
                    </div>
                </div>

                <div class="group relative bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 fade-up border border-golden-cokro/20"
                    style="transition-delay: 100ms;">
                    <div class="h-72 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1000&auto=format&fit=crop"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute top-4 right-4 bg-golden-cokro text-black text-xs font-bold px-3 py-2 rounded-lg shadow-md uppercase tracking-wider">
                            ★ Best Seller
                        </div>
                    </div>
                    <div class="p-8 text-center relative">
                        <div
                            class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-parchment rounded-full flex items-center justify-center border border-golden-cokro">
                            <span class="text-xl">🥘</span>
                        </div>
                        <h3 class="font-heritage text-2xl font-bold text-forest-green mb-2 mt-4">Nasi Pecel Pincuk</h3>
                        <p class="text-gray-600 text-sm mb-4 font-modern line-clamp-2">Sayuran segar dari petani lokal
                            disiram sambal pecel medok khas Madiun-Ponorogo.</p>
                        <p class="font-heritage text-2xl text-heritage-red font-bold">Rp 18.000</p>
                    </div>
                </div>

                <div class="group relative bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 fade-up border border-golden-cokro/20"
                    style="transition-delay: 200ms;">
                    <div class="h-72 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1000&auto=format&fit=crop"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute top-4 right-4 bg-golden-cokro text-black text-xs font-bold px-3 py-2 rounded-lg shadow-md uppercase tracking-wider">
                            ★ Best Seller
                        </div>
                    </div>
                    <div class="p-8 text-center relative">
                        <div
                            class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-parchment rounded-full flex items-center justify-center border border-golden-cokro">
                            <span class="text-xl">🥤</span>
                        </div>
                        <h3 class="font-heritage text-2xl font-bold text-forest-green mb-2 mt-4">Es Dawet Jabung</h3>
                        <p class="text-gray-600 text-sm mb-4 font-modern line-clamp-2">Minuman legendaris dengan cendol
                            alami, santan gurih, dan gula aren asli.</p>
                        <p class="font-heritage text-2xl text-heritage-red font-bold">Rp 12.000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white relative">
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none"
            style="background-image: radial-gradient(#1B5E20 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-10 fade-up">
                <h2 class="font-heritage text-4xl text-forest-green font-bold mb-6">Jelajahi Rasa</h2>

                <div class="flex flex-wrap justify-center gap-4 mb-12" id="menuTabs">
                    <button onclick="switchTab('berat')"
                        class="tab-btn px-6 py-2 rounded-full border-2 border-forest-green text-forest-green font-bold hover:bg-forest-green hover:text-white transition active-tab"
                        data-target="berat">Makanan Berat</button>
                    <button onclick="switchTab('camilan')"
                        class="tab-btn px-6 py-2 rounded-full border-2 border-forest-green text-forest-green font-bold hover:bg-forest-green hover:text-white transition"
                        data-target="camilan">Camilan</button>
                    <button onclick="switchTab('wedangan')"
                        class="tab-btn px-6 py-2 rounded-full border-2 border-forest-green text-forest-green font-bold hover:bg-forest-green hover:text-white transition"
                        data-target="wedangan">Wedangan</button>
                </div>
            </div>

            <div id="menuContent" class="min-h-[100px] fade-up">
                <div id="berat-content" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 tab-pane">
                    <div class="flex items-center gap-4 p-4 border rounded-lg hover:shadow-md transition bg-parchment">
                        <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150"
                            class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <h4 class="font-bold text-forest-green font-heritage">Ayam Lodho</h4>
                            <span class="text-heritage-red font-bold text-sm">Rp 28.000</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 border rounded-lg hover:shadow-md transition bg-parchment">
                        <img src="https://images.unsplash.com/photo-1626804475297-411dbe11261c?w=150"
                            class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <h4 class="font-bold text-forest-green font-heritage">Rawon Setan</h4>
                            <span class="text-heritage-red font-bold text-sm">Rp 30.000</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 border rounded-lg hover:shadow-md transition bg-parchment">
                        <img src="https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=150"
                            class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <h4 class="font-bold text-forest-green font-heritage">Soto Lamongan</h4>
                            <span class="text-heritage-red font-bold text-sm">Rp 22.000</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 border rounded-lg hover:shadow-md transition bg-parchment">
                        <img src="https://images.unsplash.com/photo-1596450523098-9994c6575196?w=150"
                            class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <h4 class="font-bold text-forest-green font-heritage">Bebek Goreng</h4>
                            <span class="text-heritage-red font-bold text-sm">Rp 32.000</span>
                        </div>
                    </div>
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

    <section class="py-24 bg-forest-green text-parchment relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 mix-blend-overlay"
            style="background-image: url('https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1000&auto=format&fit=crop');">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 fade-up">
                    <h3 class="text-golden-cokro font-bold tracking-widest uppercase text-sm mb-4">Filosofi Kami</h3>
                    <h2 class="font-heritage text-4xl lg:text-5xl font-bold mb-6 leading-tight">Lebih dari Sekadar
                        <br>Tempat Makan
                    </h2>
                    <p class="font-modern text-lg opacity-90 mb-6 leading-relaxed">
                        "Dam Cokro" bukan hanya nama, tapi sebuah janji. Diambil dari semangat menjaga aliran tradisi agar
                        tetap jernih dan menghidupi.
                    </p>
                    <p class="font-modern text-lg opacity-90 mb-8 leading-relaxed">
                        Kami bekerja sama langsung dengan petani lokal Ponorogo untuk mendapatkan rempah terbaik. Proses
                        memasak kami masih mempertahankan teknik 'slow cooking' menggunakan tungku kayu untuk menu-menu
                        tertentu, demi menjaga aroma asap yang khas.
                    </p>
                </div>

                <div class="lg:w-1/2 relative fade-up" style="transition-delay: 200ms;">
                    <div class="absolute -top-4 -left-4 w-24 h-24 border-t-4 border-l-4 border-golden-cokro"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 border-b-4 border-r-4 border-golden-cokro"></div>
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1000&auto=format&fit=crop"
                        class="w-full h-[500px] object-cover rounded-lg shadow-2xl filter sepia-[.3] grayscale-[.5] hover:grayscale-0 transition duration-700">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-parchment">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 fade-up">
                <div>
                    <h2 class="font-heritage text-4xl text-forest-green font-bold mb-2">Sudut Estetik</h2>
                    <p class="text-gray-600">Abadikan momen terbaikmu di Dam Cokro.</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-2">
                    <a href="#"
                        class="bg-linear-to-tr from-yellow-400 via-red-500 to-purple-500 text-white px-4 py-2 rounded-lg font-bold text-sm flex items-center gap-2 hover:shadow-lg transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                        @ponorogo.dreamland
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-[600px] fade-up">
                <div class="col-span-2 row-span-2 relative rounded-2xl overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1000&auto=format&fit=crop"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-linear-to-t from-black/70 to-transparent">
                        <p class="text-white text-sm font-modern">Area Semi-Outdoor yang sejuk</p>
                    </div>
                </div>
                <div class="col-span-1 row-span-1 relative rounded-2xl overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=500&auto=format&fit=crop"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>
                <div class="col-span-1 row-span-2 relative rounded-2xl overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=500&auto=format&fit=crop"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-linear-to-t from-black/70 to-transparent">
                        <p class="text-white text-sm font-modern">Detail Interior Kayu Jati</p>
                    </div>
                </div>
                <div class="col-span-1 row-span-1 relative rounded-2xl overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1592861956120-e524fc739696?q=80&w=500&auto=format&fit=crop"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // Restaurant Page Scripts
        // Colors are now defined in resources/css/app.css via Tailwind v4 @theme directive

        // 2. SCROLL ANIMATION (Intersection Observer)
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });

        // 3. TAB LOGIC (Simple JS)
        function switchTab(category) {
            // Update Button Styles
            document.querySelectorAll('.tab-btn').forEach(btn => {
                if (btn.dataset.target === category) {
                    btn.classList.add('bg-[#1B5E20]', 'text-white');
                    btn.classList.remove('text-[#1B5E20]');
                } else {
                    btn.classList.remove('bg-[#1B5E20]', 'text-white');
                    btn.classList.add('text-[#1B5E20]');
                }
            });

            // Mock Content Switching (In Real Project, you might fetch data or show/hide divs)
            // Disini saya buat simulasi simple ganti konten
            const contentDiv = document.getElementById('menuContent');
            contentDiv.style.opacity = '0';

            setTimeout(() => {
                // Logic ganti isi HTML berdasarkan category (Bisa diganti AJAX)
                let htmlContent = '';

                if (category === 'berat') {
                    htmlContent = `
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    ${createCard('Ayam Lodho', '28.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Rawon Setan', '30.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Soto Lamongan', '22.000', 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=150')}
                    ${createCard('Bebek Goreng', '32.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
               </div>`;
                } else if (category === 'camilan') {
                    htmlContent = `
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    ${createCard('Tempe Mendoan', '10.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Tahu Walik', '12.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Pisang Goreng', '15.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Singkong Keju', '12.000', 'https://images.unsplash.com/photo-1517244683847-7456b63c5969?w=150')}
               </div>`;
                } else {
                    htmlContent = `
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    ${createCard('Wedang Uwuh', '10.000', 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=150')}
                    ${createCard('Jahe Geprek', '8.000', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=150')}
                    ${createCard('Teh Poci', '15.000', 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=150')}
                    ${createCard('Kopi Tubruk', '10.000', 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?w=150')}
               </div>`;
                }

                contentDiv.innerHTML = htmlContent;
                contentDiv.style.opacity = '1';
            }, 300);
        }

        // Helper function for demo
        function createCard(name, price, img) {
            return `
        <div class="flex items-center gap-4 p-4 border rounded-lg hover:shadow-md transition bg-[#FFF8E1]">
            <img src="${img}" class="w-20 h-20 rounded-lg object-cover">
            <div>
                <h4 class="font-bold text-[#1B5E20] font-heritage">${name}</h4>
                <span class="text-[#B71C1C] font-bold text-sm">Rp ${price}</span>
            </div>
        </div>
        `;
        }

        // Initialize first tab
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.tab-btn[data-target="berat"]').click();
        });
    </script>
@endsection
