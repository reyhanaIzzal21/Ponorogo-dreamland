{{-- Package List Layout - For prasmanan and nasi box --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($category->items as $item)
        <div
            class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden relative group hover:shadow-md transition">
            <div class="bg-forest-green p-4 text-white relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-white/10 rounded-full"></div>
                <h3 class="font-heritage text-xl font-bold">{{ $item->name }}</h3>
                <p class="text-golden-cokro font-bold mt-1">{{ $item->formatted_price }}</p>
            </div>
            <div class="p-6">
                <ul class="space-y-2">
                    @foreach ($item->packageContents as $content)
                        <li class="flex items-start text-sm text-zinc-700">
                            <svg class="w-4 h-4 text-heritage-red mr-2 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            {{ $content->content_name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="h-2 w-full bg-golden-cokro"></div>
        </div>
    @endforeach
</div>
