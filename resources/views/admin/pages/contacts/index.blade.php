@extends('admin.layouts.app')

@section('style')
    <style>
        /* Hide Scrollbar */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom Theme: Indigo */
        .input-contact:focus {
            --tw-ring-color: #4F46E5;
            border-color: #4F46E5;
        }

        /* Hover & Focus States for Cards */
        .social-card {
            transition: all 0.3s ease;
        }

        .social-card:focus-within,
        .social-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Brand Specific Colors on Focus */
        .card-wa:focus-within {
            border-color: #25D366;
            background-color: #F0FDF4;
        }

        .card-ig:focus-within {
            border-color: #E1306C;
            background-color: #FFF1F2;
        }

        .card-tt:focus-within {
            border-color: #000000;
            background-color: #F9FAFB;
        }

        .card-email:focus-within {
            border-color: #4F46E5;
            background-color: #EEF2FF;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="contactCMS('{{ $contact->maps_embed_url }}')">
        <form action="{{ route('admin.contacts.update') }}" method="POST">
            @csrf
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-2">
                        <span
                            class="bg-primary/10 text-primary text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Global
                            Settings</span>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800">Kontak & Lokasi</h1>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">Kelola kanal komunikasi dan peta lokasi.</p>
                </div>

                <div class="flex gap-3 w-full md:w-auto">
                    <a href="/contact" target="_blank"
                        class="flex-1 md:flex-none justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 flex items-center gap-2 text-sm font-medium transition">
                        Live Preview
                    </a>
                    <button type="submit"
                        class="flex-1 md:flex-none justify-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-700 flex items-center gap-2 text-sm font-medium shadow-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        Simpan Update
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 h-full">
                        <div class="border-b border-gray-100 pb-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-primary/10 text-primary rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">Kanal Digital</h2>
                                    <p class="text-gray-500 text-xs">Akun sosial media & kontak online.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-5">

                            <div class="social-card card-wa border border-gray-200 rounded-xl p-1 bg-white">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase ml-3 mt-2">WhatsApp
                                    Official</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-6 h-6 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="whatsapp_number"
                                        class="w-full bg-transparent border-none focus:ring-0 text-sm p-3 pl-12 text-gray-800 font-bold placeholder-gray-300"
                                        placeholder="62812xxxxxx"
                                        value="{{ old('whatsapp_number', $contact->whatsapp_number ?? '') }}">
                                </div>
                            </div>

                            <div class="social-card card-ig border border-gray-200 rounded-xl p-1 bg-white">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase ml-3 mt-2">Instagram
                                    Link</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-6 h-6 text-[#E1306C]" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.162c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                    </div>
                                    <input type="url" name="instagram_url"
                                        class="w-full bg-transparent border-none focus:ring-0 text-sm p-3 pl-12 text-gray-800 placeholder-gray-300"
                                        value="{{ old('instagram_url', $contact->instagram_url ?? '') }}">
                                </div>
                            </div>

                            <div class="social-card card-tt border border-gray-200 rounded-xl p-1 bg-white">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase ml-3 mt-2">TikTok
                                    Link</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.35a6.015 6.015 0 0 1 3.99-5.77V.02z" />
                                        </svg>
                                    </div>
                                    <input type="url" name="tiktok_url"
                                        class="w-full bg-transparent border-none focus:ring-0 text-sm p-3 pl-12 text-gray-800 placeholder-gray-300"
                                        value="{{ old('tiktok_url', $contact->tiktok_url ?? '') }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 h-full">
                        <div class="border-b border-gray-100 pb-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-primary/10 text-primary rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">Lokasi Fisik</h2>
                                    <p class="text-gray-500 text-xs">Alamat & Peta Google Maps.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                                <textarea rows="4" name="address"
                                    class="input-contact w-full border-gray-300 rounded-lg shadow-sm p-3 text-sm focus:ring-primary"
                                    placeholder="Jl. Raya Ponorogo...">{{ old('address', $contact->address ?? '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Google Maps Embed URL</label>
                                <div class="relative">
                                    <input type="text" name="maps_embed_url" x-model="embedUrl"
                                        class="input-contact w-full border-gray-300 rounded-lg shadow-sm p-3 pl-10 text-sm focus:ring-primary"
                                        placeholder="https://www.google.com/maps/embed?..."
                                        value="{{ old('maps_embed_url', $contact->maps_embed_url ?? '') }}">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="mt-3 p-3 bg-primary/10 border border-primary/10 rounded-lg flex gap-3">
                                    <div class="text-primary flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-xs text-primary leading-tight">
                                        <strong>Tips:</strong> Buka Google Maps, klik tombol "Share" -> "Embed a map", lalu
                                        copy
                                        link yang ada di dalam tanda kutip <code>src="..."</code>.
                                    </div>
                                </div>
                            </div>

                            {{-- <div
                                class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl h-40 flex items-center justify-center relative overflow-hidden group">
                                <div
                                    class="absolute inset-0 bg-gray-200/50 flex flex-col items-center justify-center text-gray-400 group-hover:text-gray-600 transition">
                                    <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.447-.894L15 4m0 13V4m0 0L9 7">
                                        </path>
                                    </svg>
                                    <span class="text-xs font-bold uppercase tracking-wider">Map Preview Area</span>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>

            </div>
            {{-- <iframe x-show="embedUrl" :src="embedUrl" class="absolute inset-0 w-full h-full" frameborder="0"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
            {{-- <div x-show="!embedUrl"
                class="absolute inset-0 bg-gray-200/50 flex flex-col items-center justify-center text-gray-400 group-hover:text-gray-600 transition">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.447-.894L15 4m0 13V4m0 0L9 7">
                    </path>
                </svg>
                <span class="text-xs font-bold uppercase tracking-wider">Map Preview Area</span>
            </div> --}}
    </div>

    </div>
    </div>
    </div>

    </div>
    </form>
    </div>
@endsection

@section('script')
    @include('admin.pages.contacts.scripts.index')
@endsection
