{{-- Grid Photo Layout - Standard ala carte --}}
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
    @foreach ($category->items as $item)
        <div
            class="bg-white rounded-xl shadow-sm hover:shadow-md transition border border-zinc-100 overflow-hidden group">
            <div class="h-40 overflow-hidden relative">
                <img src="{{ $item->image_url ?? $item->image_path }}" alt="{{ $item->name }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500" loading="lazy">
            </div>
            <div class="p-4">
                <h3 class="font-bold text-zinc-800 text-sm md:text-base leading-tight mb-2 min-h-[40px]">
                    {{ $item->name }}
                </h3>
                <p class="text-heritage-red font-bold text-sm">{{ $item->formatted_price }}</p>
            </div>
        </div>
    @endforeach
</div>
