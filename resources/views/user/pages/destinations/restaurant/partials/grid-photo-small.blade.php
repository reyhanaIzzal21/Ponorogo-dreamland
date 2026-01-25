{{-- Grid Photo Small Layout - For drinks --}}
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
    @foreach ($category->items as $item)
        <div
            class="bg-white rounded-lg p-3 shadow-sm border border-zinc-100 hover:border-forest-green transition flex flex-col items-center text-center">
            <img src="{{ $item->image_url ?? $item->image_path }}" alt="{{ $item->name }}"
                class="w-20 h-20 rounded-full object-cover mb-3 bg-zinc-100" loading="lazy">
            <h3 class="font-bold text-zinc-800 text-sm leading-tight mb-1">{{ $item->name }}</h3>
            <p class="text-heritage-red font-bold text-xs">{{ $item->formatted_price }}</p>
        </div>
    @endforeach
</div>
