@forelse ($reservations as $item)
    <tr class="hover-row transition duration-150">
        {{-- Tamu --}}
        <td class="p-4 whitespace-nowrap">
            <p class="font-bold text-gray-900">{{ $item->user_name }}</p>
            <div class="flex items-center gap-1 text-gray-500 text-xs mt-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                    </path>
                </svg>
                <span>{{ $item->user_whatsapp }}</span>
            </div>
        </td>

        {{-- Jadwal --}}
        <td class="p-4 whitespace-nowrap">
            <span
                class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide mb-1 inline-block bg-indigo-50 text-indigo-700">
                {{ $item->destination->name }}
            </span>
            <p class="font-medium text-gray-800">{{ $item->reservation_date->format('d M Y') }}
            </p>
        </td>

        {{-- Jml Org --}}
        <td class="p-4 whitespace-nowrap">
            <p class="text-gray-800"><span class="font-bold">{{ $item->number_of_people }}</span>
                Org</p>
        </td>

        {{-- Keperluan --}}
        <td class="p-4 min-w-[150px]">
            <p class="text-gray-800 text-sm">{{ $item->needs }}</p>
        </td>

        {{-- Catatan --}}
        <td class="p-4 min-w-[150px]">
            <span class="text-gray-500 text-xs italic">
                {{ $item->notes ?? '-' }}
            </span>
        </td>

        {{-- Status WA --}}
        <td class="p-4 text-center whitespace-nowrap">
            @if ($item->wa_sent)
                <span class="text-green-600 font-bold">Terkirim</span>
                <p class="text-gray-500 text-xs mt-1">
                    {{ $item->wa_sent_at->format('d M Y H:i') }}
                </p>
            @else
                <form action="{{ route('admin.reservation.resend', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-600 font-bold hover:underline"
                        title="Klik untuk kirim ulang">
                        Kirim Ulang
                    </button>
                </form>
                <p class="text-gray-500 text-xs mt-1">
                    {{ Str::limit($item->wa_error, 20) }}
                </p>
            @endif
        </td>

        {{-- Aksi --}}
        <td class="p-4 text-right whitespace-nowrap">
            <a href="{{ route('admin.reservation.show', $item->id) }}"
                class="inline-block px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold hover:bg-indigo-100 transition">
                Detail
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="p-8 text-center text-gray-500">
            Tidak ada data reservasi ditemukan.
        </td>
    </tr>
@endforelse
