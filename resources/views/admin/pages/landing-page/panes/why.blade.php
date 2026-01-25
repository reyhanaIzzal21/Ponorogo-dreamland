<div x-show="activeTab === 'why'" class="p-4 md:p-8 space-y-6" x-transition.opacity>
    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
        <h2 class="text-lg md:text-xl font-bold text-gray-800">Why Choose Us</h2>
        @php
            $features = $whySection->extra_data['features'] ?? [];
            $featureCount = count($features);
        @endphp
        <span class="text-[10px] md:text-xs bg-gray-200 text-gray-500 font-bold px-2 py-1 rounded">
            {{ $featureCount }}/4 Features
        </span>
    </div>

    <form action="{{ route('admin.landing-page.why.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            @php
                $defaultFeatures = [
                    [
                        'icon' => '📍',
                        'title' => 'Lokasi Strategis',
                        'description' => 'Mudah dijangkau, tepat di jantung aktivitas dan kenyamanan.',
                    ],
                    [
                        'icon' => '✨',
                        'title' => 'Fasilitas Lengkap',
                        'description' => 'One-stop destination: Makan, Acara, dan Hiburan keluarga.',
                    ],
                    [
                        'icon' => '🤝',
                        'title' => 'Pelayanan Ramah',
                        'description' => 'Keramahan khas Ponorogo dengan standar layanan profesional.',
                    ],
                    [
                        'icon' => '🏛️',
                        'title' => 'Suasana Otentik',
                        'description' => 'Perpaduan desain modern dan sentuhan tradisional Jawa.',
                    ],
                ];
                $features = $whySection->extra_data['features'] ?? $defaultFeatures;
            @endphp

            @foreach ($features as $index => $feature)
                <div class="border border-gray-200 p-4 rounded-xl hover:shadow-md transition bg-white group">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <input type="text" name="features[{{ $index }}][icon]"
                                class="w-10 h-10 bg-green-100 rounded-lg text-xl text-center border-0 focus:ring-2 focus:ring-green-500"
                                value="{{ $feature['icon'] }}" maxlength="4">
                        </div>
                        <div class="flex-1 space-y-2 min-w-0">
                            <input type="text" name="features[{{ $index }}][title]"
                                class="w-full text-sm font-bold border-0 border-b border-gray-200 focus:ring-0 px-0 py-1"
                                value="{{ $feature['title'] }}" placeholder="Judul Feature">
                            <textarea rows="2" name="features[{{ $index }}][description]"
                                class="w-full text-xs text-gray-600 border-0 bg-gray-50 rounded p-2 focus:ring-0"
                                placeholder="Deskripsi feature...">{{ $feature['description'] }}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit"
            class="px-6 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 text-sm font-medium shadow-lg transition">
            Simpan Why Choose Us
        </button>
    </form>
</div>
