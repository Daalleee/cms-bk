<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="HypnoKonseling - Pulihkan Diri dari Kecanduan, Raih Kembali Kendali Hidupmu">
    <meta name="keywords" content="hypnokonseling, hipnoterapi, kecanduan, konseling, terapi">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HypnoKonseling - Pulihkan Diri, Raih Kendali')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        html { scroll-behavior: smooth; scroll-padding-top: 80px; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ mobileOpen: false, scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })">

    <nav :class="scrolled ? 'bg-white shadow-lg py-2' : 'bg-white/95 backdrop-blur-md py-4'" class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/#hero" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('storage/media/logo/logo.jpeg') }}" alt="HypnoKonseling" class="h-14 w-auto">
                    <span class="text-2xl font-black text-gray-900 tracking-tight">Hypno<span class="text-indigo-600">Konseling</span></span>
                </a>

                <div class="hidden md:flex items-center space-x-1 lg:space-x-8">
                    <a href="/#hero" class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 transition rounded-lg hover:bg-indigo-50">Beranda</a>
                    <a href="/#tentang" class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 transition rounded-lg hover:bg-indigo-50">Tentang</a>
                    <a href="/#alur" class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 transition rounded-lg hover:bg-indigo-50">Alur</a>
                    <a href="/#area" class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 transition rounded-lg hover:bg-indigo-50">Area</a>
                    <a href="/#testimoni" class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 transition rounded-lg hover:bg-indigo-50">Testimoni</a>
                    <a href="/#kontak" class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 transition rounded-lg hover:bg-indigo-50">Kontak</a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->whatsapp ?? '') }}" target="_blank" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-full font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition shadow-lg hover:shadow-indigo-500/30 ml-2">
                        Konsultasi
                    </a>
                </div>

                <button @click="mobileOpen = !mobileOpen" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="mobileOpen" x-cloak @click.outside="mobileOpen = false" class="md:hidden bg-white border-t border-gray-100 shadow-xl">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="/#hero" @click="mobileOpen = false" class="block py-3 text-base font-medium text-gray-700 border-b border-gray-50 hover:text-indigo-600">Beranda</a>
                <a href="/#tentang" @click="mobileOpen = false" class="block py-3 text-base font-medium text-gray-700 border-b border-gray-50 hover:text-indigo-600">Tentang</a>
                <a href="/#alur" @click="mobileOpen = false" class="block py-3 text-base font-medium text-gray-700 border-b border-gray-50 hover:text-indigo-600">Alur</a>
                <a href="/#area" @click="mobileOpen = false" class="block py-3 text-base font-medium text-gray-700 border-b border-gray-50 hover:text-indigo-600">Area</a>
                <a href="/#testimoni" @click="mobileOpen = false" class="block py-3 text-base font-medium text-gray-700 border-b border-gray-50 hover:text-indigo-600">Testimoni</a>
                <a href="/#kontak" @click="mobileOpen = false" class="block py-3 text-base font-medium text-gray-700 border-b border-gray-50 hover:text-indigo-600">Kontak</a>
                <div class="py-4">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->whatsapp ?? '') }}" target="_blank" class="flex justify-center items-center px-6 py-3 bg-indigo-600 rounded-full font-bold text-white shadow-lg">
                        Konsultasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-2xl font-black tracking-tight">Hypno<span class="text-indigo-400">Konseling</span></span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 max-w-md">
                        {{ $hero->sub_judul ?? 'Pendekatan HypnoKonseling untuk membantu proses perubahan perilaku secara lebih efektif.' }}
                    </p>
                    <div class="flex space-x-4">
                        @if($kontak && $kontak->youtube)
                            <a href="https://youtube.com/@{{ $kontak->youtube }}" target="_blank" class="text-gray-400 hover:text-red-500 transition">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        @endif
                        @if($kontak && $kontak->instagram)
                            <a href="https://instagram.com/{{ $kontak->instagram }}" target="_blank" class="text-gray-400 hover:text-pink-500 transition">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0c-3.254 0-3.662.014-4.94.072-2.766.127-4.648 1.181-5.593 2.665-.78 1.225-1.023 2.705-1.062 4.191-.025.905-.025 1.185-.025 3.072s0 2.167.025 3.072c.039 1.486.282 2.966 1.062 4.191.945 1.484 2.828 2.538 5.593 2.665 1.278.057 1.686.072 4.94.072 3.254 0 3.662-.015 4.94-.072 2.766-.127 4.648-1.181 5.593-2.665.78-1.225 1.023-2.705 1.062-4.191.025-.905.025-1.185.025-3.072s0-2.167-.025-3.072c-.039-1.486-.282-2.966-1.062-4.191-.945-1.484-2.828-2.538-5.593-2.665C15.662.014 15.254 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.405-10.405a1.44 1.44 0 1 0 0 2.88 1.44 1.44 0 0 0 0-2.88z"/></svg>
                            </a>
                        @endif
                        @if($kontak && $kontak->facebook)
                            <a href="https://facebook.com/{{ $kontak->facebook }}" target="_blank" class="text-gray-400 hover:text-blue-500 transition">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if($kontak && $kontak->twitter)
                            <a href="https://twitter.com/{{ $kontak->twitter }}" target="_blank" class="text-gray-400 hover:text-sky-400 transition">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="text-md font-bold text-white mb-6 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="/#hero" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="/#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="/#alur" class="hover:text-white transition">Alur Penanganan</a></li>
                        <li><a href="/#area" class="hover:text-white transition">Area Kecanduan</a></li>
                        <li><a href="/#testimoni" class="hover:text-white transition">Testimoni</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-bold text-white mb-6 uppercase tracking-wider">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $kontak->alamat ?? '-' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>{{ $kontak->telepon ?? '-' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>{{ $kontak->email ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-500 text-sm">
                <div>&copy; {{ date('Y') }} HypnoKonseling. All rights reserved.</div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-full text-xs font-semibold transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-full text-xs transition">Login Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
