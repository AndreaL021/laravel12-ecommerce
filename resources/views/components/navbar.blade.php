@php
    $categories_items = $categories
        ->map(
            fn($cat) => [
                'id' => $cat['id'],
                'name' => __($cat['name']),
            ],
        )
        ->toArray();
    array_unshift($categories_items, ['id' => null, 'name' => __('Seleziona')]);

    $selected_items = collect($categories)->firstWhere('id', request('category'));
    $selected_items = $selected_items
        ? [['id' => $selected_items->id, 'name' => __($selected_items->name)]]
        : [['id' => null, 'name' => __('navbar.selected')]];
@endphp
<nav class="bg-gray-800 fixed top-0 left-0 w-full z-50">
    <div class="w-full sm:px-3 px-0">
        <div class="flex flex-wrap items-center justify-between gap-y-2 py-2 px-2">
            <div class="flex flex-1 items-center justify-start">
                <div class="flex shrink-0">
                    <img class="h-8 w-auto object-contain"
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company" />
                </div>
                <div class="ml-6">
                    <div class="flex space-x-4">
                        <a href="{{ route('home') }}" class="font-medium text-white" aria-current="page"><i
                                class="fa-solid fa-house"></i></a>

                    </div>
                </div>
            </div>

            <!-- Search -->
            <div
                class="w-full sm:w-auto order-3 sm:order-none sm:absolute sm:left-1/2 sm:transform sm:-translate-x-1/2">
                <div class="relative">

                    <form
                        action="{{ Route::currentRouteName() === 'announcement.index' || Route::currentRouteName() === 'announcement.search' ? route('announcement.search') : route('search') }}"
                        method="GET" @submit="loading = true">

                        <div class="flex">
                            <x-select :selectedItems="$selected_items" :rounded="false" label="{{ __('announcement.categories') }}"
                                :items="$categories_items" name="category"></x-select>
                            <input placeholder="{{ __('navbar.search') }}" id="search" name="search"
                                autocomplete="search" value="{{ request('search') }}"
                                class="w-full px-4 py-2 pr-10 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

                            <button type="submit"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex items-center space-x-2 sm:ml-auto">
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
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 bg-white border rounded shadow">
                        <ul>
                            <li>
                                <form method="POST" action="{{ route('locale.switch', 'en') }}"
                                    @submit="loading = true">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 w-full text-left">
                                        <x-flag-language-en class="w-5 h-5" /> English
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('locale.switch', 'it') }}"
                                    @submit="loading = true">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 w-full text-left">
                                        <x-flag-language-it class="w-5 h-5" /> Italiano
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('locale.switch', 'fr') }}"
                                    @submit="loading = true">
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
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
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
                                <img class="size-8 rounded-full object-contain"
                                    src="{{ auth()->user()?->img ? asset('storage/' . auth()->user()->img) : asset('images/user.png') }}"
                                    alt="error" />
                            </button>
                        </div>
                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem">{{ __('navbar.settings') }}</a>
                            <a href="{{ route('announcement.index') }}" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem">{{ __('navbar.my_announcements') }}</a>
                            <a href="{{ route('announcement.create') }}" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem">{{ __('navbar.create_announcement') }}</a>
                            <form method="POST" action="{{ route('logout') }}" @submit="loading = true">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('navbar.sign out') }}
                                </button>
                            </form>
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
</nav>
