<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('storage/media/logo/logo.jpeg') }}" alt="HypnoKonseling" class="h-9 w-auto">
                            <span class="text-lg font-black text-gray-900 tracking-tight">Hypno<span class="text-indigo-600">Konseling</span></span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.hero-section.index')" :active="request()->routeIs('admin.hero-section.*')">
                        {{ __('Hero') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.tentang-section.index')" :active="request()->routeIs('admin.tentang-section.*') || request()->routeIs('admin.tentang-kami.*')">
                        {{ __('Tentang') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.tahapan-penanganan.index')" :active="request()->routeIs('admin.tahapan-penanganan.*')">
                        {{ __('Alur') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.area-kecanduan.index')" :active="request()->routeIs('admin.area-kecanduan.*')">
                        {{ __('Kecanduan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.testimoni.index')" :active="request()->routeIs('admin.testimoni.*')">
                        {{ __('Testimoni') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.kontak.index')" :active="request()->routeIs('admin.kontak.*')">
                        {{ __('Kontak') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.pesan-masuk.index')" :active="request()->routeIs('admin.pesan-masuk.*')">
                        {{ __('Pesan') }}
                    </x-nav-link>
                    @if(Auth::user()->peran === 'super_admin')
                        <x-nav-link :href="route('admin.pengguna.index')" :active="request()->routeIs('admin.pengguna.*')">
                            {{ __('Pengguna') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.log-aktivitas.index')" :active="request()->routeIs('admin.log-aktivitas.*')">
                            {{ __('Log') }}
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('home')" target="_blank">
                        {{ __('Lihat Website') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->nama }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.hero-section.index')">
                {{ __('Hero') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.tentang-section.index')">
                {{ __('Tentang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.tahapan-penanganan.index')">
                {{ __('Alur') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.area-kecanduan.index')">
                {{ __('Kecanduan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.testimoni.index')">
                {{ __('Testimoni') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.kontak.index')">
                {{ __('Kontak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.pesan-masuk.index')">
                {{ __('Pesan') }}
            </x-responsive-nav-link>
            @if(Auth::user()->peran === 'super_admin')
                <x-responsive-nav-link :href="route('admin.pengguna.index')">
                    {{ __('Pengguna') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.log-aktivitas.index')">
                    {{ __('Log') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('home')" target="_blank">
                {{ __('Lihat Website') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->nama }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
