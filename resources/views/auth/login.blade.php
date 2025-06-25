<x-layout>
    <x-slot name="title">Login</x-slot>
    <div class="flex items-center justify-center min-h-screen">

        <div class="w-full md:w-1/3 mx-3">
            <form method="POST" action="{{ route('login') }}" @submit="loading = true">
                @csrf
                {{-- <x-snackbar>
    <x-slot name="title">test</x-slot>
    <x-slot name="message">message</x-slot>
    </x-snackbar> --}}
                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('login.email')" />
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" :value="__('login.password')" />
                    <div class="relative">
                        <input id="password" class="block mt-1 w-full" :type="show ? 'text' : 'password'"
                            name="password" required autocomplete="password">

                        <!-- Icona -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                            @click="show = !show">
                            <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-400 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('login.remember') }}</span>
                    </label>
                </div>

                <!-- Bottone -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full"
                    :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    {{ __('login.login') }}
                </button>

                <div class="mt-4 text-center">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('register') }}">
                        {{ __('login.newaccount') }}
                    </a>
                </div>
            </form>

        </div>
    </div>

</x-layout>
