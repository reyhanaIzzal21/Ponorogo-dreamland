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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <template x-for="dest in destinations" :key="dest.id">
                <div class="dest-card bg-white rounded-2xl border border-gray-200 overflow-hidden flex flex-col h-full">

                    <div class="h-48 relative overflow-hidden group">
                        <img :src="dest.image"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">

                        <div class="absolute top-4 right-4">
                            <span :class="getStatusClass(dest.status)"
                                class="text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm"
                                x-text="getStatusLabel(dest.status)"></span>
                        </div>

                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-black/50 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded border border-white/20"
                                x-text="dest.type"></span>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800" x-text="dest.name"></h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-6 flex-1 line-clamp-2" x-text="dest.desc"></p>

                        <div class="flex items-center gap-4 text-xs text-gray-400 mb-6 border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <span x-text="dest.views + ' Views'"></span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span x-text="'Updated: ' + dest.updated"></span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button @click="openModal('edit', dest)"
                                class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-xs font-bold flex items-center justify-center gap-2 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </button>

                            <a :href="dest.cms_link"
                                class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 text-xs font-bold flex items-center justify-center gap-2 shadow-md transition transform hover:-translate-y-0.5">
                                <span>Isi Konten</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
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
