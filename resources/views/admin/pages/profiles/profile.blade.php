@extends('admin.layouts.app')

@section('style')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom Indigo Theme for Admin Profile */
        .input-profile:focus {
            --tw-ring-color: #4F46E5;
            /* Indigo-600 */
            border-color: #4F46E5;
        }

        /* Avatar Upload Overlay */
        .avatar-group:hover .avatar-overlay {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen" x-data="profileManager()">

        <div class="mb-8">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800">Profile Settings</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola informasi akun dan keamanan Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="border-b border-gray-100 pb-4 mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Informasi Pribadi</h3>
                            <p class="text-xs text-gray-500">Update data diri dan email kontak.</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-bold">Simpan</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </span>
                                <input type="text"
                                    class="input-profile w-full border-gray-300 rounded-lg pl-10 py-2.5 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="Admin Ponorogo">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Email Address</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="email"
                                    class="input-profile w-full border-gray-300 rounded-lg pl-10 py-2.5 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="admin@ponorogodreamland.com">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Keamanan</h3>
                        <p class="text-xs text-gray-500">Ubah password secara berkala untuk keamanan.</p>
                    </div>

                    <div class="space-y-4">

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Password Saat Ini</label>
                            <div class="relative">
                                <input :type="showOld ? 'text' : 'password'"
                                    class="input-profile w-full border-gray-300 rounded-lg py-2.5 px-3 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="••••••••">
                                <button @click="showOld = !showOld"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg x-show="!showOld" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <svg x-show="showOld" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Password Baru</label>
                                <div class="relative">
                                    <input :type="showNew ? 'text' : 'password'"
                                        class="input-profile w-full border-gray-300 rounded-lg py-2.5 px-3 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Min. 8 karakter">
                                    <button @click="showNew = !showNew"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <svg x-show="!showNew" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        <svg x-show="showNew" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Konfirmasi
                                    Password</label>
                                <div class="relative">
                                    <input :type="showConfirm ? 'text' : 'password'"
                                        class="input-profile w-full border-gray-300 rounded-lg py-2.5 px-3 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Ulangi password">
                                    <button @click="showConfirm = !showConfirm"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        <svg x-show="showConfirm" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button
                                class="px-6 py-2.5 bg-gray-800 text-white text-sm font-bold rounded-lg hover:bg-black shadow-lg transition">
                                Update Password
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('profileManager', () => ({
                // State untuk Toggle Mata (Show/Hide Password)
                showOld: false,
                showNew: false,
                showConfirm: false,
            }))
        })
    </script>
@endsection
