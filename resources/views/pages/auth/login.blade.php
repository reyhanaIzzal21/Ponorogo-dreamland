@extends('user.layouts.app')

@section('style')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom Focus Ring untuk konsistensi */
        .admin-input:focus {
            outline: none;
            border-color: #2D7D32;
            /* primary */
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-zinc-900">

        <div class="w-full h-screen flex overflow-hidden">

            <div class="hidden lg:flex w-1/2 relative justify-center items-center overflow-hidden bg-black">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1500" alt="Admin Workspace"
                        class="w-full h-full object-cover opacity-40 grayscale">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent"></div>
                </div>

                <div class="relative z-10 px-12 max-w-lg">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="p-2 bg-primary rounded-lg shadow-lg shadow-primary/50">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-white font-mono text-sm tracking-widest uppercase opacity-70">Internal
                            System</span>
                    </div>
                    <h1 class="font-sans text-5xl font-bold text-white mb-6 tracking-tight leading-tight">
                        Ponorogo Dreamland <br> <span class="text-primary">Management Portal</span>
                    </h1>
                    <div class="h-1 w-20 bg-primary mb-6"></div>
                    <p class="text-zinc-400 text-lg font-light">
                        Akses terbatas untuk Administrator dan Staff. Silakan masuk untuk mengelola konten, reservasi, dan
                        pengaturan sistem.
                    </p>
                    <div class="mt-8 py-4 px-6 bg-white/5 border border-white/10 rounded-lg backdrop-blur-sm inline-block">
                        <p class="text-xs text-zinc-500 flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            System Status: <strong>Operational</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-zinc-50 px-6 py-12 relative">

                <div class="w-full max-w-md bg-white p-8 md:p-10">

                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-zinc-900">Login</h2>
                        <p class="mt-2 text-sm text-zinc-500">
                            Masukkan kredensial Anda untuk melanjutkan.
                        </p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-zinc-700 mb-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="email" placeholder="name@gmail.com"
                                class="admin-input w-full bg-zinc-50 border text-zinc-900 text-sm rounded-lg block p-2.5 @error('email') border-red-500 @else border-zinc-300 @enderror focus:ring-primary focus:border-primary" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1" x-data="{ show: false }">
                            <div class="flex justify-between items-center mb-1">
                                <label class="block text-sm font-bold text-zinc-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs text-primary hover:text-indigo-800 font-bold" wire:navigate>
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>

                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password" required
                                    autocomplete="current-password" placeholder="••••••••"
                                    class="admin-input w-full bg-zinc-50 border text-zinc-900 text-sm rounded-lg block p-2.5 pr-10 @error('password') border-red-500 @else border-zinc-300 @enderror">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-600 focus:outline-none">
                                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                        </path>
                                    </svg>
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white font-bold py-3 px-4 rounded-lg shadow-lg shadow-primary/30 transition transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Masuk
                        </button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
@endsection
