<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Layanan Bimbingan Konseling dan Hypnocounseling profesional untuk kesehatan mental dan pengembangan diri.">
    <meta name="keywords" content="konseling, hypnocounseling, bimbingan konseling, kesehatan mental, terapi trauma">
    <title>@yield('title', 'CMS Bimbingan Konseling')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navbar -->
    <nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
                            CMS BK
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Beranda</x-nav-link>
                        <x-nav-link :href="route('tentang-kami')" :active="request()->routeIs('tentang-kami')">Tentang Kami</x-nav-link>
                        <x-nav-link :href="route('frontend.hypnocounseling')" :active="request()->routeIs('frontend.hypnocounseling')">Hypnocounseling</x-nav-link>
                        <x-nav-link :href="route('frontend.area-penanganan')" :active="request()->routeIs('frontend.area-penanganan')">Area</x-nav-link>
                        <x-nav-link :href="route('frontend.tahapan-penanganan')" :active="request()->routeIs('frontend.tahapan-penanganan')">Tahapan</x-nav-link>
                        <x-nav-link :href="route('frontend.testimoni')" :active="request()->routeIs('frontend.testimoni')">Testimoni</x-nav-link>
                        <x-nav-link :href="route('frontend.galeri')" :active="request()->routeIs('frontend.galeri')">Galeri</x-nav-link>
                        <x-nav-link :href="route('frontend.kontak')" :active="request()->routeIs('frontend.kontak')">Kontak</x-nav-link>
                    </div>
                </div>
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Beranda</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tentang-kami')" :active="request()->routeIs('tentang-kami')">Tentang Kami</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('frontend.hypnocounseling')" :active="request()->routeIs('frontend.hypnocounseling')">Hypnocounseling</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('frontend.area-penanganan')" :active="request()->routeIs('frontend.area-penanganan')">Area</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('frontend.tahapan-penanganan')" :active="request()->routeIs('frontend.tahapan-penanganan')">Tahapan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('frontend.testimoni')" :active="request()->routeIs('frontend.testiomni')">Testimoni</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('frontend.galeri')" :active="request()->routeIs('frontend.galeri')">Galeri</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('frontend.kontak')" :active="request()->routeIs('frontend.kontak')">Kontak</x-responsive-nav-link>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold text-indigo-600 mb-4">CMS BK</h3>
                    <p class="text-gray-600">{{ $profil->judul ?? 'Bimbingan Konseling & Hypnocounseling' }}</p>
                </div>
                <div>
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a></li>
                        <li><a href="{{ route('tentang-kami') }}" class="hover:text-indigo-600">Tentang Kami</a></li>
                        <li><a href="{{ route('frontend.hypnocounseling') }}" class="hover:text-indigo-600">Hypnocounseling</a></li>
                        <li><a href="{{ route('frontend.kontak') }}" class="hover:text-indigo-600">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Hubungi Kami</h4>
                    <p class="text-gray-600">{{ $kontak->alamat ?? '-' }}</p>
                    <p class="text-gray-600 mt-2">Telp: {{ $kontak->telepon ?? '-' }}</p>
                    <p class="text-gray-600">Email: {{ $kontak->email ?? '-' }}</p>
                </div>
            </div>
            <div class="border-t border-gray-100 mt-8 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} CMS Bimbingan Konseling. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
