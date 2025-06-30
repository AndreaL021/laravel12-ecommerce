<x-layout>
    <x-slot name="title">Login</x-slot>
    <div class="flex items-center justify-center min-h-[calc(100vh-56px)]">

        <div class="w-full md:w-1/2 mx-3">


            <form method="POST" action="{{ route('login') }}" @submit="loading = true">
                @csrf
                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('auth.email')" />
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="email">
                </div>

                <!-- Password -->
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" :value="__('auth.password_label')" />
                    <div class="relative">
                        <input id="password" class="block mt-1 w-full" :type="show ? 'text' : 'password'"
                            name="password" required autocomplete="password">

                        <!-- Icona -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                            @click="show = !show">
                            <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                        </div>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-400 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('auth.remember') }}</span>
                    </label>
                </div>

                <!-- Bottone -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full"
                    :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    {{ __('auth.login') }}
                </button>

                <div class="mt-4 text-center">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('register') }}">
                        {{ __('auth.new_account') }}
                    </a>
                </div>
                <div class="mt-4 text-center">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('auth.forgotten_password') }}
                    </a>
                </div>
            </form>

        </div>
    </div>

</x-layout>
