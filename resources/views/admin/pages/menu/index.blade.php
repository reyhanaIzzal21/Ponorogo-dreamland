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

        /* Resto Theme Colors */
        .border-theme {
            border-color: #B71C1C;
        }

        .text-theme {
            color: #B71C1C;
        }

        .bg-theme {
            background-color: #B71C1C;
        }

        .bg-theme-light {
            background-color: #FEF2F2;
        }

        /* Tag Input Style for Packages */
        .tag-item {
            background: #FEF2F2;
            color: #B71C1C;
            border: 1px solid #FECACA;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="menuCMS()">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2">
                    <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">F&B
                        Manager</span>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Daftar Menu Resto</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1">Kelola kategori, harga, dan varian menu.</p>
            </div>
            <button @click="openItemModal()" x-show="currentCategory && currentCategory.type !== 'price-group'"
                class="w-full md:w-auto px-4 py-2 bg-theme text-white rounded-lg hover:bg-red-800 flex items-center justify-center gap-2 text-sm font-bold shadow-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Item Baru
            </button>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            {{-- Categories Sidebar --}}
            @include('admin.pages.menu.partials.category-sidebar')

            {{-- Main Content Area --}}
            <div
                class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px] flex flex-col">

                {{-- Category Header --}}
                <div
                    class="p-6 border-b border-gray-100 bg-gray-50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800" x-text="currentCategory?.name || 'Pilih Kategori'"></h2>
                        <p class="text-xs text-gray-500 flex items-center gap-1">
                            Layout Aktif
                            <span class="font-bold text-theme" x-text="getTypeLabel(currentCategory?.type)"></span>
                        </p>
                    </div>
                    <div class="flex gap-2" x-show="currentCategory">
                        <button @click="editCategory(currentCategory)"
                            class="text-xs text-gray-500 underline hover:text-theme">Edit Kategori</button>
                        <button @click="confirmDeleteCategory(currentCategory)"
                            class="text-xs text-red-500 underline hover:text-red-700">Hapus</button>
                    </div>
                </div>

                {{-- Content Area --}}
                <div class="p-6 flex-1 bg-gray-50/50">
                    {{-- Loading State --}}
                    <div x-show="isLoading" class="flex items-center justify-center h-64">
                        <svg class="animate-spin h-8 w-8 text-theme" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>

                    {{-- Empty State --}}
                    <div x-show="!isLoading && categories.length === 0"
                        class="flex flex-col items-center justify-center h-64 text-gray-400">
                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        <p class="text-lg font-bold">Belum Ada Kategori Menu</p>
                        <p class="text-sm">Klik "Kategori Baru" untuk memulai</p>
                    </div>

                    {{-- Grid Photo Types --}}
                    <template
                        x-if="!isLoading && currentCategory && ['grid-photo', 'grid-promo', 'grid-photo-small'].includes(currentCategory.type)">
                        @include('admin.pages.menu.partials.item-grid')
                    </template>

                    {{-- Package List Type --}}
                    <template x-if="!isLoading && currentCategory && currentCategory.type === 'package-list'">
                        @include('admin.pages.menu.partials.item-package')
                    </template>

                    {{-- Price Group Type --}}
                    <template x-if="!isLoading && currentCategory && currentCategory.type === 'price-group'">
                        @include('admin.pages.menu.partials.item-price-group')
                    </template>
                </div>
            </div>
        </div>

        {{-- Modals --}}
        @include('admin.pages.menu.modals.category-form')
        @include('admin.pages.menu.modals.item-form')
        @include('admin.pages.menu.modals.price-group-form')

        {{-- Delete Confirmation Modal --}}
        <div x-show="isDeleteModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" x-transition.opacity>
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm p-6 m-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-gray-600 text-sm mb-4" x-text="deleteMessage"></p>
                <div class="flex justify-end gap-2">
                    <button @click="isDeleteModalOpen = false"
                        class="px-4 py-2 text-gray-600 text-sm font-bold hover:bg-gray-100 rounded-lg transition">Batal</button>
                    <button @click="executeDelete()" :disabled="isSubmitting"
                        class="px-4 py-2 bg-red-500 text-white text-sm font-bold rounded-lg hover:bg-red-600 transition disabled:opacity-50">
                        <span x-show="!isSubmitting">Hapus</span>
                        <span x-show="isSubmitting">Menghapus...</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    @include('admin.pages.menu.scripts.index')
@endsection
