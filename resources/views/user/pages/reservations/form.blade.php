@extends('user.layouts.app')

@php
    // Logika Sederhana di View untuk menentukan Tema Warna & Judul
    $type = request()->query('type', 'resto'); // Default ke resto jika null

    if ($type == 'pendopo') {
        $themeColor = 'earth'; // Class color dari app.css
        $themeHex = '#795548';
        $title = 'Inquiry Sewa Pendopo';
        $image = 'https://images.unsplash.com/photo-1519225421980-715cb0202128?q=80&w=800';
    } else {
        $themeColor = 'primary'; // Class color dari app.css (Green)
        $themeHex = '#2D7D32';
        $title = 'Reservasi Meja Resto';
        $image = 'https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=800';
    }
@endphp

@section('style')
    <style>
        /* Custom Checkbox & Radio Styling */
        .custom-radio:checked+div {
            border-color: var(--color-{{ $themeColor }});
            background-color: #f0fdf4;
            /* Light Green/Brown tint handled by logic below */
            color: var(--color-{{ $themeColor }});
        }

        /* Input Focus Ring Color Dynamic */
        .input-dynamic:focus {
            --tw-ring-color: {{ $themeHex }};
            border-color: {{ $themeHex }};
        }

        /* Validated State */
        .is-valid {
            border-color: #10B981 !important;
            /* Green-500 */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310B981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>
@endsection

@section('content')
    <div class="bg-zinc-900 pt-28 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-30 bg-cover bg-center"
            style="background-image: url('{{ $image }}'); filter: blur(8px);"></div>
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold tracking-widest uppercase mb-2">
                Step 2 of 2
            </span>
            <h1 class="font-serif text-3xl md:text-4xl text-white font-bold">{{ $title }}</h1>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-24">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">

            <div class="w-full md:w-1/3 bg-zinc-50 border-r border-zinc-100 p-8">
                <div class="sticky top-8">
                    <h3 class="font-bold text-zinc-800 text-lg mb-4">Detail Pilihan</h3>

                    <div class="bg-white p-4 rounded-xl border border-zinc-200 shadow-sm mb-6 flex items-start gap-4">
                        <img src="{{ $image }}" class="w-16 h-16 rounded-lg object-cover">
                        <div>
                            <p class="text-xs text-zinc-500 uppercase font-bold">Venue</p>
                            <h4 class="font-heritage font-bold text-{{ $themeColor }} text-lg">
                                {{ $type == 'pendopo' ? 'Pendopo Ageng' : 'Dam Cokro Resto' }}
                            </h4>
                            <a href="{{ route('reservation') }}"
                                class="text-xs text-zinc-400 underline hover:text-zinc-600">Ganti Venue</a>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-zinc-500">Konfirmasi instan via WhatsApp Admin.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-sm text-zinc-500">Data Anda aman dan terenkripsi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-2/3 p-8 md:p-12">
                <form id="reservationForm" onsubmit="return showRecap(event)">

                    <div class="mb-10">
                        <h2 class="font-serif text-2xl text-zinc-800 font-bold mb-6 flex items-center gap-2">
                            <span
                                class="w-8 h-8 rounded-full bg-{{ $themeColor }} text-white text-sm flex items-center justify-center">1</span>
                            Data Pemesan
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-bold text-zinc-700 mb-2">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="name" required
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                    placeholder="Contoh: Budi Santoso">
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-bold text-zinc-700 mb-2">WhatsApp <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" id="whatsapp" required
                                    class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                    placeholder="0812xxxx (Wajib Aktif)" oninput="validatePhone(this)">
                                <p class="text-xs text-zinc-400 mt-1" id="wa-hint">Gunakan format angka saja.</p>
                            </div>
                        </div>
                    </div>

                    <hr class="border-dashed border-zinc-200 my-8">

                    <div class="mb-10">
                        <h2 class="font-serif text-2xl text-zinc-800 font-bold mb-6 flex items-center gap-2">
                            <span
                                class="w-8 h-8 rounded-full bg-{{ $themeColor }} text-white text-sm flex items-center justify-center">2</span>
                            Detail {{ $type == 'pendopo' ? 'Acara' : 'Kunjungan' }}
                        </h2>

                        @if ($type == 'resto')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Kunjungan</label>
                                    <input type="date" id="date" required
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Jam Kedatangan</label>
                                    <input type="time" id="time" required
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Jumlah Orang</label>
                                    <input type="number" id="pax" min="1" max="20"
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                        placeholder="Max 20 orang">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Keperluan</label>
                                    <input type="text" id="need" required
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm" placeholder="contoh: wedding, pesta, dll.">
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Catatan Khusus</label>
                                    <textarea id="notes"
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm h-24"
                                        placeholder="Contoh: Tolong sediakan 1 baby chair, alergi kacang, dll."></textarea>
                                </div>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Jenis Acara</label>
                                    <input type="text" id="event_type" required
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Estimasi Peserta</label>
                                    <input type="number" id="pax" min="50"
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                        placeholder="Contoh: 200">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Durasi (Jam/Hari)</label>
                                    <input type="text" id="duration"
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm"
                                        placeholder="Contoh: 5 Jam / 1 Hari">
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-sm font-bold text-zinc-700 mb-3">Add-ons (Opsional)</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label
                                            class="flex items-center space-x-3 p-3 border border-zinc-200 rounded-lg hover:bg-zinc-50 cursor-pointer">
                                            <input type="checkbox" name="addons" value="Sound System"
                                                class="w-5 h-5 text-{{ $themeColor }} rounded focus:ring-{{ $themeColor }}">
                                            <span class="text-sm text-zinc-700 font-medium">Sound System Standard</span>
                                        </label>
                                        <label
                                            class="flex items-center space-x-3 p-3 border border-zinc-200 rounded-lg hover:bg-zinc-50 cursor-pointer">
                                            <input type="checkbox" name="addons" value="Panggung"
                                                class="w-5 h-5 text-{{ $themeColor }} rounded focus:ring-{{ $themeColor }}">
                                            <span class="text-sm text-zinc-700 font-medium">Panggung / Stage</span>
                                        </label>
                                        <label
                                            class="flex items-center space-x-3 p-3 border border-zinc-200 rounded-lg hover:bg-zinc-50 cursor-pointer">
                                            <input type="checkbox" name="addons" value="Catering Dam Cokro"
                                                class="w-5 h-5 text-{{ $themeColor }} rounded focus:ring-{{ $themeColor }}">
                                            <span class="text-sm text-zinc-700 font-medium">Catering Dam Cokro</span>
                                        </label>
                                        <label
                                            class="flex items-center space-x-3 p-3 border border-zinc-200 rounded-lg hover:bg-zinc-50 cursor-pointer">
                                            <input type="checkbox" name="addons" value="Cleaning Service"
                                                class="w-5 h-5 text-{{ $themeColor }} rounded focus:ring-{{ $themeColor }}">
                                            <span class="text-sm text-zinc-700 font-medium">Extra Cleaning</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-sm font-bold text-zinc-700 mb-2">Detail Konsep /
                                        Permintaan</label>
                                    <textarea id="notes"
                                        class="input-dynamic w-full bg-white border border-zinc-300 rounded-lg p-3 outline-none transition shadow-sm h-24"
                                        placeholder="Jelaskan kebutuhan spesifik Anda di sini..."></textarea>
                                </div>
                            </div>
                        @endif

                    </div>

                    <button type="submit"
                        class="w-full bg-{{ $themeColor }} hover:opacity-90 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center gap-2 text-lg">
                        Lanjut ke Ringkasan
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>

                </form>
            </div>
        </div>
    </div>

    <div id="recapModal"
        class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform scale-95 opacity-0 transition-all duration-300"
            id="recapContent">
            <div class="bg-{{ $themeColor }} p-4 text-white text-center">
                <h3 class="font-serif font-bold text-xl">Konfirmasi Data</h3>
                <p class="text-xs opacity-90">Mohon periksa kembali sebelum mengirim.</p>
            </div>
            <div class="p-6">
                <div class="space-y-3 text-sm text-zinc-600 mb-6" id="recapList">
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeRecap()"
                        class="flex-1 px-4 py-2 border border-zinc-300 rounded-lg text-zinc-600 font-bold hover:bg-zinc-50">
                        Edit Kembali
                    </button>
                    <button type="button" onclick="sendToWhatsApp()"
                        class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                        Kirim WA
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // 1. REAL-TIME VALIDATION
        function validatePhone(input) {
            const value = input.value;
            const hint = document.getElementById('wa-hint');
            // Regex: Hanya angka, minimal 10 digit
            const regex = /^[0-9]{10,15}$/;

            if (regex.test(value)) {
                input.classList.add('is-valid');
                input.classList.remove('border-red-500');
                hint.classList.add('text-green-600');
                hint.innerText = "Format valid ✔";
            } else {
                input.classList.remove('is-valid');
                // Opsional: tambahkan border merah jika ingin strict
                hint.classList.remove('text-green-600');
                hint.innerText = "Gunakan format angka saja (10-15 digit).";
            }
        }

        // 2. MODAL LOGIC (Visual Recap)
        const type = "{{ $type }}"; // 'resto' or 'pendopo'

        function showRecap(e) {
            e.preventDefault(); // Mencegah reload halaman

            const modal = document.getElementById('recapModal');
            const content = document.getElementById('recapContent');
            const list = document.getElementById('recapList');

            // Ambil Data Umum
            const name = document.getElementById('name').value;
            const wa = document.getElementById('whatsapp').value;
            const pax = document.getElementById('pax').value;
            const notes = document.getElementById('notes').value || '-';

            let detailHTML = `
            <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Nama:</span> <span class="font-bold text-zinc-800">${name}</span></div>
            <div class="flex justify-between border-b border-zinc-100 pb-2"><span>WhatsApp:</span> <span class="font-bold text-zinc-800">${wa}</span></div>
            <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Pax:</span> <span class="font-bold text-zinc-800">${pax} Orang</span></div>
        `;

            if (type === 'resto') {
                const date = document.getElementById('date').value;
                const time = document.getElementById('time').value;
                const occasion = document.getElementById('occasion').value;
                const area = document.querySelector('input[name="area"]:checked').value;

                detailHTML += `
                <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Tanggal:</span> <span class="font-bold text-zinc-800">${date}</span></div>
                <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Jam:</span> <span class="font-bold text-zinc-800">${time}</span></div>
                <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Area:</span> <span class="font-bold text-zinc-800">${area}</span></div>
                <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Acara:</span> <span class="font-bold text-zinc-800">${occasion}</span></div>
            `;
            } else {
                const eventType = document.getElementById('eventType').value;
                const duration = document.getElementById('duration').value;

                // Get Checkboxes
                let addons = [];
                document.querySelectorAll('input[name="addons"]:checked').forEach(cb => addons.push(cb.value));
                const addonsStr = addons.length > 0 ? addons.join(', ') : '-';

                detailHTML += `
                <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Tipe Acara:</span> <span class="font-bold text-zinc-800">${eventType}</span></div>
                <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Durasi:</span> <span class="font-bold text-zinc-800">${duration}</span></div>
                <div class="flex justify-between border-b border-zinc-100 pb-2"><span>Add-ons:</span> <span class="font-bold text-zinc-800 text-right text-xs max-w-[150px]">${addonsStr}</span></div>
            `;
            }

            detailHTML += `<div class="mt-2 text-xs italic text-zinc-500">Catatan: "${notes}"</div>`;

            list.innerHTML = detailHTML;

            // Show Modal
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);

            return false;
        }

        function closeRecap() {
            const modal = document.getElementById('recapModal');
            const content = document.getElementById('recapContent');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // 3. WHATSAPP GENERATOR
        function sendToWhatsApp() {
            const adminPhone = '6281234567890'; // Ganti dengan nomor Admin
            const name = document.getElementById('name').value;
            const pax = document.getElementById('pax').value;
            const notes = document.getElementById('notes').value;

            let text =
                `Halo Admin Ponorogo Dreamland, saya ingin reservasi *${type === 'resto' ? 'RESTO' : 'PENDOPO'}*:%0a%0a`;
            text += `👤 Nama: ${name}%0a`;
            text += `👥 Jumlah: ${pax} Orang%0a`;

            if (type === 'resto') {
                const date = document.getElementById('date').value;
                const time = document.getElementById('time').value;
                const area = document.querySelector('input[name="area"]:checked').value;
                text += `📅 Tanggal: ${date}%0a`;
                text += `⏰ Jam: ${time}%0a`;
                text += `📍 Area: ${area}%0a`;
            } else {
                const eventType = document.getElementById('eventType').value;
                const duration = document.getElementById('duration').value;
                text += `🎉 Acara: ${eventType}%0a`;
                text += `⏳ Durasi: ${duration}%0a`;
            }

            if (notes) text += `📝 Catatan: ${notes}`;

            window.open(`https://wa.me/${adminPhone}?text=${text}`, '_blank');
            closeRecap();
        }
    </script>
@endsection
