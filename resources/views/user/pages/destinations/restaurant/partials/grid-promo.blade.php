{{-- Grid Promo Layout - Large cards with description --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach ($category->items as $item)
        <div
            class="bg-white rounded-2xl overflow-hidden shadow-lg border border-golden-cokro transform hover:-translate-y-1 transition duration-300">
            <div class="h-48 overflow-hidden relative">
                @if ($item->is_promo && $item->promo_badge)
                    <div
                        class="absolute top-4 right-4 bg-heritage-red text-white text-xs font-bold px-3 py-1 rounded-full z-10">
                        {{ $item->promo_badge }}
                    </div>
                @endif
                <img src="{{ $item->image_url ?? $item->image_path }}" alt="{{ $item->name }}"
                    class="w-full h-full object-cover" loading="lazy">
            </div>
            <div class="p-6">
                <h3 class="font-heritage text-2xl font-bold text-zinc-800 mb-2">{{ $item->name }}</h3>
                @if ($item->description)
                    <p class="text-zinc-500 text-sm mb-4 h-10">{{ $item->description }}</p>
                @endif
                <div class="flex justify-between items-center border-t border-dashed border-zinc-200 pt-4">
                    <span class="text-heritage-red font-bold text-xl">{{ $item->formatted_price }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
