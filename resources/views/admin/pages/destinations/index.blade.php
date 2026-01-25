@extends('admin.layouts.app')

@section('style')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Status Badge Colors */
        .status-open {
            background-color: #DCFCE7;
            color: #166534;
            border: 1px solid #BBF7D0;
        }

        .status-closed {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        .status-soon {
            background-color: #F3F4F6;
            color: #4B5563;
            border: 1px solid #E5E7EB;
            border-style: dashed;
        }

        .status-maintenance {
            background-color: #FFEDD5;
            color: #9A3412;
            border: 1px solid #FED7AA;
        }

        /* Card Hover Lift */
        .dest-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dest-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="destinationMaster()">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2">
                    <span
                        class="bg-indigo-100 text-indigo-800 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Master
                        Data</span>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Kelola Destinasi</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1">Atur status operasional dan informasi dasar unit bisnis.</p>
            </div>

            <button @click="openModal('add')"
                class="w-full md:w-auto px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center justify-center gap-2 text-sm font-bold shadow-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Unit Baru
            </button>
        </div>

        {{-- Loading State --}}
        <div x-show="isLoading" class="flex justify-center items-center py-20">
            <svg class="animate-spin h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>

        {{-- Empty State --}}
        <div x-show="!isLoading && destinations.length === 0" class="text-center py-20">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                </path>
            </svg>
            <h3 class="text-lg font-bold text-gray-600 mb-2">Belum ada destinasi</h3>
            <p class="text-gray-400 text-sm mb-4">Klik tombol "Tambah Unit Baru" untuk memulai.</p>
        </div>

        <div x-show="!isLoading && destinations.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <template x-for="dest in destinations" :key="dest.id">
                <div class="dest-card bg-white rounded-2xl border border-gray-200 overflow-hidden flex flex-col h-full">

                    <div class="h-48 relative overflow-hidden group">
                        <img :src="dest.cover_image_url || 'https://via.placeholder.com/600x400?text=No+Image'"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">

                        <div class="absolute top-4 right-4">
                            <span :class="getStatusClass(dest.status)"
                                class="text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm"
                                x-text="getStatusLabel(dest.status)"></span>
                        </div>

                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-black/50 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded border border-white/20"
                                x-text="dest.type_label"></span>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800" x-text="dest.name"></h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6 flex-1 line-clamp-2"
                            x-text="dest.description || 'Tidak ada deskripsi'"></p>

                        <div class="flex items-center gap-4 text-xs text-gray-400 mb-6 border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span x-text="'Updated: ' + dest.updated_at"></span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 w-full">
                            <button @click="openModal('edit', dest)"
                                class="flex-1 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-xs font-bold flex items-center justify-center gap-2 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </button>
                            <button @click="confirmDelete(dest)"
                                class="py-2 px-3 bg-white border border-red-300 text-red-600 rounded-lg hover:bg-red-50 text-xs font-bold flex items-center justify-center gap-2 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>

        </div>

        @include('admin.pages.destinations.modals.form')

    </div>
@endsection

@section('script')
    @include('admin.pages.destinations.scripts.index')
@endsection
