@extends('admin.layouts.app')

@section('style')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Status Badges for Reservation */
        .badge-pending {
            @apply bg-yellow-100 text-yellow-800 border-yellow-200;
        }

        .badge-confirmed {
            @apply bg-green-100 text-green-800 border-green-200;
        }

        .badge-cancelled {
            @apply bg-red-100 text-red-800 border-red-200;
        }

        .badge-done {
            @apply bg-gray-100 text-gray-800 border-gray-200;
        }

        /* Status Badges for WhatsApp Notification */
        .wa-sent {
            @apply bg-green-50 text-green-600 border-green-200;
        }

        .wa-failed {
            @apply bg-red-50 text-red-600 border-red-200;
        }

        /* Table Row Hover */
        .hover-row:hover td {
            @apply bg-gray-50;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="reservationManager()">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Reservation Data</h1>
                <p class="text-gray-500 text-sm mt-1">Pantau semua reservasi masuk dari Website & WhatsApp.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <div class="relative flex-1 md:flex-none">
                    <input type="date"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ date('Y-m-d') }}">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>

                <button
                    class="flex-1 md:flex-none px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 flex items-center justify-center gap-2 text-sm font-bold shadow-md transition transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Export Excel
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">ALL
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Total Reservasi</p>
                    <h4 class="text-xl font-bold text-gray-800">1,240</h4>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Perlu Konfirmasi</p>
                    <h4 class="text-xl font-bold text-yellow-600">5 Baru</h4>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">Confirmed Today</p>
                    <h4 class="text-xl font-bold text-green-600">12 Tamu</h4>
                </div>
            </div>
            <div
                class="bg-white p-4 rounded-xl border border-red-200 shadow-sm flex items-center gap-4 relative overflow-hidden">
                <div class="absolute right-0 top-0 p-1 bg-red-500 text-white text-[10px] font-bold rounded-bl">ALERT</div>
                <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold">WA Failed</p>
                    <h4 class="text-xl font-bold text-red-600">2 Pesan</h4>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            <div class="p-4 border-b border-gray-100 flex flex-col md:flex-row gap-4 justify-between">
                <div class="flex gap-2 overflow-x-auto hide-scroll">
                    <button @click="filter = 'all'"
                        :class="filter === 'all' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold transition">Semua</button>
                    <button @click="filter = 'resto'"
                        :class="filter === 'resto' ? 'bg-green-600 text-white' :
                            'bg-green-50 text-green-700 hover:bg-green-100'"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold transition">Resto</button>
                    <button @click="filter = 'pendopo'"
                        :class="filter === 'pendopo' ? 'bg-orange-600 text-white' :
                            'bg-orange-50 text-orange-700 hover:bg-orange-100'"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold transition">Pendopo</button>
                </div>
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Cari nama atau no WA..."
                        class="w-full pl-9 pr-4 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="p-4 font-bold">Tamu & Kontak</th>
                            <th class="p-4 font-bold">Venue & Waktu</th>
                            <th class="p-4 font-bold">Detail</th>
                            <th class="p-4 font-bold text-center">WA Notif</th>
                            <th class="p-4 font-bold text-center">Status</th>
                            <th class="p-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">

                        <template x-for="item in filteredItems" :key="item.id">
                            <tr class="hover-row transition duration-150">
                                <td class="p-4">
                                    {{-- nama --}}
                                    <p class="font-bold text-gray-900" x-text="item.name"></p>

                                    {{-- whatsapp --}}
                                    <div class="flex items-center gap-1 text-gray-500 text-xs mt-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        <span x-text="item.wa"></span>
                                    </div>
                                </td>

                                <td class="p-4">
                                    {{-- vanue(destinasi) --}}
                                    <span
                                        :class="item.venue === 'Resto' ? 'text-green-600 bg-green-50' :
                                            'text-orange-600 bg-orange-50'"
                                        class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide mb-1 inline-block"
                                        x-text="item.venue"></span>

                                    {{-- tanggal --}}
                                    <p class="font-medium text-gray-800" x-text="item.date"></p>

                                    {{-- waktu --}}
                                    <p class="text-gray-500 text-xs" x-text="item.time"></p>
                                </td>

                                <td class="p-4">
                                    {{-- jumlah tamu --}}
                                    <p class="text-gray-800"><span class="font-bold" x-text="item.pax"></span> Org</p>

                                    {{-- keperluan --}}
                                    <p class="text-gray-500 text-xs italic truncate w-32" x-text="item.occasion"></p>
                                </td>

                                <td class="p-4 text-center">
                                    <template x-if="item.wa_status === 'sent'">
                                        <div class="inline-flex items-center gap-1 px-2 py-1 rounded-full border wa-sent text-xs font-bold"
                                            title="Pesan Terkirim">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Sent
                                        </div>
                                    </template>
                                    <template x-if="item.wa_status === 'failed'">
                                        <button @click="resendWA(item.id)"
                                            class="inline-flex items-center gap-1 px-2 py-1 rounded-full border wa-failed text-xs font-bold hover:bg-red-100 transition animate-pulse"
                                            title="Klik untuk kirim ulang">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                </path>
                                            </svg>
                                            Failed
                                        </button>
                                    </template>
                                </td>

                                <td class="p-4 text-center">
                                    <span :class="getStatusClass(item.status)"
                                        class="px-2 py-1 rounded border text-xs font-bold uppercase"
                                        x-text="item.status"></span>
                                </td>

                                <td class="p-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button @click="viewDetail(item)"
                                            class="p-1.5 rounded bg-white border border-gray-200 text-gray-500 hover:text-indigo-600 hover:border-indigo-300 transition"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button
                                            class="p-1.5 rounded bg-white border border-gray-200 text-gray-500 hover:text-green-600 hover:border-green-300 transition"
                                            title="Konfirmasi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                <span>Menampilkan 1-10 dari 1,240 data</span>
                <div class="flex gap-1">
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Prev</button>
                    <button
                        class="px-3 py-1 border rounded bg-indigo-50 text-indigo-600 font-bold border-indigo-200">1</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>

        <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
            x-transition.opacity>
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md m-4 overflow-hidden"
                @click.away="modalOpen = false">
                <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Detail Reservasi</h3>
                    <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <div class="p-6 space-y-4" x-data="{ detail: selectedItem }">

                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Pemesan</p>
                            <h4 class="font-bold text-lg text-gray-800" x-text="detail.name"></h4>
                            <p class="text-sm text-indigo-600 font-mono" x-text="detail.wa"></p>
                        </div>
                        <div class="text-right">
                            <span :class="getStatusClass(detail.status)"
                                class="px-2 py-1 rounded border text-xs font-bold uppercase"
                                x-text="detail.status"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Venue</p>
                            <p class="font-bold text-gray-800" x-text="detail.venue"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Pax</p>
                            <p class="font-bold text-gray-800"><span x-text="detail.pax"></span> Orang</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                            <p class="font-bold text-gray-800" x-text="detail.date"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Jam</p>
                            <p class="font-bold text-gray-800" x-text="detail.time"></p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Catatan Khusus</p>
                        <div class="p-3 bg-yellow-50 border border-yellow-100 rounded-lg text-sm text-gray-700 italic">
                            "<span x-text="detail.notes || 'Tidak ada catatan'"></span>"
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-500">Status Pesan WA:</span>
                        <span :class="detail.wa_status === 'sent' ? 'text-green-600' : 'text-red-600'"
                            class="font-bold text-sm flex items-center gap-1">
                            <span x-text="detail.wa_status === 'sent' ? '✓ Terkirim Otomatis' : '⚠ Gagal Terkirim'"></span>
                            <button x-show="detail.wa_status === 'failed'"
                                class="text-xs underline ml-2 text-indigo-600">Coba Lagi</button>
                        </span>
                    </div>

                </div>
                <div class="p-4 bg-gray-50 flex gap-2">
                    <button
                        class="flex-1 py-2 border border-gray-300 rounded-lg text-gray-600 font-bold hover:bg-white transition">Tolak</button>
                    <button
                        class="flex-1 py-2 bg-indigo-600 rounded-lg text-white font-bold hover:bg-indigo-700 transition">Konfirmasi</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reservationManager', () => ({
                filter: 'all',
                modalOpen: false,
                selectedItem: {}, // Placeholder for modal data

                // DUMMY DATA LENGKAP
                reservations: [{
                        id: 1,
                        name: 'Budi Santoso',
                        wa: '081234567890',
                        venue: 'Resto',
                        date: '28 Jan 2026',
                        time: '19:00',
                        pax: 4,
                        occasion: 'Makan Malam',
                        notes: 'Minta meja dekat kolam ikan ya',
                        wa_status: 'sent', // WA Terkirim
                        status: 'confirmed'
                    },
                    {
                        id: 2,
                        name: 'Siti Aminah',
                        wa: '085678901234',
                        venue: 'Pendopo',
                        date: '10 Feb 2026',
                        time: '09:00',
                        pax: 200,
                        occasion: 'Wedding',
                        notes: 'Butuh test food minggu depan',
                        wa_status: 'failed', // WA Gagal (Perlu Alert)
                        status: 'pending'
                    },
                    {
                        id: 3,
                        name: 'Andi Pratama',
                        wa: '081122334455',
                        venue: 'Resto',
                        date: '28 Jan 2026',
                        time: '12:00',
                        pax: 2,
                        occasion: 'Meeting Casual',
                        notes: '',
                        wa_status: 'sent',
                        status: 'pending'
                    },
                    {
                        id: 4,
                        name: 'CV Maju Jaya',
                        wa: '089988776655',
                        venue: 'Pendopo',
                        date: '15 Feb 2026',
                        time: '08:00',
                        pax: 50,
                        occasion: 'Gathering',
                        notes: 'Butuh sound system tambahan',
                        wa_status: 'sent',
                        status: 'done'
                    }
                ],

                // Computed Property Logic (Simulated in Alpine)
                get filteredItems() {
                    if (this.filter === 'all') return this.reservations;
                    // Simple filter logic (case insensitive)
                    return this.reservations.filter(item => item.venue.toLowerCase() === this
                        .filter);
                },

                // Status Styling Logic
                getStatusClass(status) {
                    const classes = {
                        'pending': 'badge-pending',
                        'confirmed': 'badge-confirmed',
                        'cancelled': 'badge-cancelled',
                        'done': 'badge-done'
                    };
                    return classes[status] || 'bg-gray-100';
                },

                // Action: View Detail Modal
                viewDetail(item) {
                    this.selectedItem = item;
                    this.modalOpen = true;
                },

                // Action: Resend WA
                resendWA(id) {
                    alert('Mengirim ulang notifikasi WA ke ID: ' + id + '...');
                    // Di sini nanti logic AJAX ke backend
                    // Setelah sukses, update this.reservations[index].wa_status = 'sent'
                }
            }))
        })
    </script>
@endsection
