@extends('user.layouts.app')

@section('content')
    <div class="bg-zinc-900 pt-32 pb-24 relative overflow-hidden min-h-screen flex items-center justify-center">
        <!-- Background accents -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-xl w-full px-4">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden text-center p-8 md:p-12">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="font-serif text-3xl text-zinc-800 font-bold mb-4">Reservasi Berhasil!</h2>
                <p class="text-zinc-600 mb-8 leading-relaxed">
                    Terima kasih <strong>{{ $reservation->user_name }}</strong>, reservasi Anda telah kami terima.
                    Konfirmasi selanjutnya akan dikirimkan melalui WhatsApp ke nomor
                    <strong>{{ $reservation->user_whatsapp }}</strong>.
                </p>

                <div class="bg-zinc-50 rounded-xl p-6 mb-8 text-left border border-zinc-100">
                    <h3 class="font-bold text-zinc-800 mb-4 border-b border-zinc-200 pb-2">Detail Reservasi</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-zinc-500">ID Tiket</span>
                            <span class="font-mono font-bold text-zinc-700">#{{ substr($reservation->id, 0, 8) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-500">Venue</span>
                            <span class="font-bold text-zinc-800">{{ $reservation->destination->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-500">Tanggal</span>
                            <span
                                class="font-bold text-zinc-800">{{ $reservation->reservation_date->format('d F Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-500">Jumlah Tamu</span>
                            <span class="font-bold text-zinc-800">{{ $reservation->number_of_people }} Orang</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-500">Keperluan</span>
                            <span class="font-bold text-zinc-800">{{ $reservation->needs }}</span>
                        </div>
                        @if ($reservation->notes)
                            <div class="pt-2 mt-2 border-t border-zinc-200">
                                <span class="block text-zinc-500 mb-1">Catatan</span>
                                <span class="block text-zinc-800 italic">"{{ $reservation->notes }}"</span>
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('home') }}"
                    class="inline-block bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection
