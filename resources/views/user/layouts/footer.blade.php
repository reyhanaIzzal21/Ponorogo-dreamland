<footer class="bg-dark text-white pt-16 pb-8 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

            <div>
                <h3 class="font-serif text-2xl font-bold text-white mb-4">Ponorogo <span
                        class="text-primary">Dreamland</span></h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Destinasi terpadu yang menggabungkan cita rasa kuliner, keanggunan tradisi, dan kegembiraan
                    rekreasi di satu tempat.
                </p>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4 text-secondary">Navigasi</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-primary transition">Beranda</a></li>
                    <li><a href="{{ route('dam-cokro-resto') }}" class="hover:text-primary transition">Dam Cokro Resto</a></li>
                    <li><a href="{{ route('pavilion') }}" class="hover:text-primary transition">Pendopo Ageng</a></li>
                    <li><a href="{{ route('pool') }}" class="hover:text-primary transition">Kolam Renang</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-primary transition">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4 text-secondary">Hubungi Kami</h4>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="text-primary mt-1">📞</span>
                        <a href="https://wa.me/6282252222650" target="_blank">+62 822-5222-2650</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-primary mt-1">📍</span>
                        <a href="https://maps.app.goo.gl/xYXZHmf8xv2EWqwT9" target="_blank">Jl. Tribusono No.54, Sambirejo, Cokromenggalan, Kec. Ponorogo, Kabupaten Ponorogo, Jawa Timur 63411</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4 text-secondary">Jam Operasional</h4>
                <ul class="space-y-2 text-gray-400 text-sm mb-6">
                    <li class="flex justify-between"><span>Restoran</span> <span>9:00 - 21:00</span></li>
                    <li class="flex justify-between"><span>Pendopo</span> <span>By Request</span></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
            &copy; 2026 Ponorogo Dreamland. All rights reserved. Designed with ❤️.
        </div>
    </div>
</footer>
