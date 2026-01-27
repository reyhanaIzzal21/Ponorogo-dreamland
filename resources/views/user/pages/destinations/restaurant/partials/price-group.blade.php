{{-- Price Group Layout - For snacks --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach ($category->priceGroups as $group)
        <div class="border-2 border-dashed border-zinc-300 rounded-2xl bg-[#FFF8E1] p-6 relative">
            <div
                class="text-center absolute -top-4 left-1/2 transform -translate-x-1/2 bg-zinc-900 text-golden-cokro font-bold px-6 py-2 rounded-full shadow-lg border-2 border-white text-md">
                Serba Rp {{ $group->formatted_price }}
            </div>

            <div class="mt-6">
                <ul class="grid grid-cols-1 gap-2 text-center">
                    @foreach ($group->items as $item)
                        <li
                            class="py-2 border-b border-zinc-200 text-zinc-700 font-bold font-modern last:border-0 hover:text-heritage-red transition cursor-default">
                            {{ $item->item_name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
