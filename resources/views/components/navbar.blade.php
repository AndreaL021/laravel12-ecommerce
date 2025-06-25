<nav class="bg-gray-800 fixed top-0 left-0 w-full z-50" x-data="{ mobileOpen: false }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-14 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" @click="mobileOpen = !mobileOpen"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset"
                    aria-controls="mobile-menu" :aria-expanded="mobileOpen.toString()">
                    {{-- icona apertura dropdown mobile --}}
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        x-show="!mobileOpen" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    {{-- icona chiusura dropdown mobile --}}
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        x-show="mobileOpen" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center hidden sm:block">
                    <img class="h-8 w-auto"
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company" />
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="#"
                            class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                            aria-current="page">{{ __('navbar.home') }}</a>
                        <a href="#"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.team') }}</a>
                        @auth
                            <a href="#"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.team') }}</a>
                            <a href="#"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.projects') }}</a>
                            <a href="#"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.calendar') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div
                class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center gap-2 px-4 py-2 bg-gray-800 text-white rounded">
                            @if (App::getLocale() === 'en')
                                <x-flag-language-en class="w-5 h-5" />
                                <span>EN</span>
                            @elseif (App::getLocale() === 'it')
                                <x-flag-language-it class="w-5 h-5" />
                                <span>IT</span>
                            @elseif (App::getLocale() === 'fr')
                                <x-flag-language-fr class="w-5 h-5" />
                                <span>FR</span>
                            @endif
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute mt-2 bg-white border rounded shadow">
                            <ul>
                                <li>
                                    <form method="POST" action="{{ route('locale.switch', 'en') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 w-full text-left">
                                            <x-flag-language-en class="w-5 h-5" /> English
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('locale.switch', 'it') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 w-full text-left">
                                            <x-flag-language-it class="w-5 h-5" /> Italiano
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('locale.switch', 'fr') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 w-full text-left">
                                            <x-flag-language-fr class="w-5 h-5" /> Français
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @auth
                    <button type="button"
                        class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                        <span class="absolute -inset-1.5"></span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>
                    <!-- Profile dropdown -->
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button type="button" @click="open = !open"
                                class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <img class="size-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="" />
                            </button>
                        </div>
                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem">{{ __('navbar.profile') }}</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem">{{ __('navbar.settings') }}</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem">{{ __('navbar.sign out') }}</a>
                        </div>
                    </div>
                @endauth
                @guest
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.login') }}</a>
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.signup') }}</a>
                @endguest
            </div>
        </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="mobileOpen">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <img class="h-8 w-auto ml-2"
                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                alt="Your Company" />
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#"
                class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                aria-current="page">{{ __('navbar.home') }}</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.team') }}</a>
            @auth
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.team') }}</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.projects') }}</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('navbar.calendar') }}</a>
            @endauth
        </div>
    </div>
</nav>