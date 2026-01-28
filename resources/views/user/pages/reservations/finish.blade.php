@extends('user.layouts.app')

@section('style')
    <style>
        /* Ticket Scallop Effect (Lubang sobekan tiket) */
        .ticket-notch {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: #f8fafc;
            /* Match body/section background */
            border-radius: 50%;
            z-index: 20;
        }

        .notch-left {
            bottom: -15px;
            left: -15px;
        }

        .notch-right {
            bottom: -15px;
            right: -15px;
        }

        /* Smooth Fade In Animation */
        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen bg-zinc-50 pt-28 pb-12 flex items-center justify-center px-4 relative overflow-hidden">

        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-green-200/30 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-80 h-80 bg-yellow-200/30 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2">
            </div>
        </div>

        <div class="relative z-10 w-full max-w-md animate-fade-up">

            <div
                class="bg-white rounded-t-3xl p-8 pt-10 text-center shadow-lg relative border-b-2 border-dashed border-zinc-200">
                <div class="relative inline-block mb-6">
                    <div class="absolute inset-0 bg-green-100 rounded-full animate-ping opacity-75"></div>
                    <div
                        class="relative w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h2 class="font-serif text-2xl md:text-3xl text-zinc-900 font-bold mb-2">Reservasi Berhasil!</h2>
                <p class="text-zinc-500 text-sm leading-relaxed px-4">
                    Halo <strong>{{ $reservation->user_name }}</strong>, Reservasi Anda sudah siap. Bukti reservasi juga telah
                    dikirim ke WhatsApp Anda.
                </p>

                <div class="ticket-notch notch-left"></div>
                <div class="ticket-notch notch-right"></div>
            </div>

            <div class="bg-white rounded-b-3xl p-8 pb-10 shadow-lg relative">

                <div class="flex justify-between items-end mb-6">
                    <div>
                        <p class="text-xs text-zinc-400 uppercase tracking-wider mb-1">Venue</p>
                        <h3 class="font-serif text-xl font-bold text-primary">{{ $reservation->destination->name }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-zinc-400 uppercase tracking-wider mb-1">Booking ID</p>
                        <span
                            class="bg-zinc-100 text-zinc-600 px-3 py-1 rounded font-mono font-bold text-sm tracking-widest">
                            #{{ substr($reservation->id, 0, 8) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-8">
                    <div>
                        <p class="text-xs text-zinc-400 uppercase mb-1">Tanggal</p>
                        <p class="font-bold text-zinc-800 text-sm md:text-base">
                            {{ $reservation->reservation_date->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-zinc-400 uppercase mb-1">Jam</p>
                        <p class="font-bold text-zinc-800 text-sm md:text-base">
                            {{ isset($reservation->time) ? $reservation->time : 'Sesuai Jadwal' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-zinc-400 uppercase mb-1">Tamu</p>
                        <p class="font-bold text-zinc-800 text-sm md:text-base">
                            {{ $reservation->number_of_people }} Orang
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-zinc-400 uppercase mb-1">Keperluan</p>
                        <p class="font-bold text-zinc-800 text-sm md:text-base truncate">
                            {{ $reservation->needs }}
                        </p>
                    </div>
                </div>

                @if ($reservation->notes)
                    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 mb-8">
                        <div class="flex gap-2">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-xs text-yellow-700 font-bold uppercase mb-1">Catatan Tambahan</p>
                                <p class="text-sm text-yellow-800 italic leading-snug">"{{ $reservation->notes }}"</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="text-center border-t border-zinc-100 pt-6 mb-8">
                    <p class="text-xs text-zinc-400 mb-2">Konfirmasi dikirim ke:</p>
                    <div
                        class="inline-flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full text-green-700 font-bold text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                        {{ $reservation->user_whatsapp }}
                    </div>
                </div>

                <a href="{{ route('home') }}"
                    class="block w-full text-center bg-primary hover:bg-green-700 text-white font-bold py-4 rounded-xl transition shadow-lg hover:shadow-green-200 transform hover:-translate-y-1">
                    Kembali ke Beranda
                </a>

                <p class="text-center mt-4 text-xs text-zinc-400">
                    Screenshot halaman ini sebagai bukti pemesanan.
                </p>
            </div>
        </div>
    </div>
@endsection
