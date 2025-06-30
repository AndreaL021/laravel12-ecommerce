<x-layout>
    <x-slot name="title">Register</x-slot>
    <div class="flex items-center justify-center min-h-[calc(100vh-56px)]">

        <div class="w-full md:w-1/2 mx-3">

            <form method="POST" action="{{ route('register') }}" @submit="loading = true">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('auth.name')" />
                    <input id="name" class="block mt-1 w-full" type="text" name="name"
                        value="{{ old('name') }}" required autofocus autocomplete="name">
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('auth.email')" />
                    <input id="email" class="block mt-1 w-full" type="text" name="email"
                        value="{{ old('email') }}" required autocomplete="username">
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

                <!-- Confirm Password -->
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password_confirmation" :value="__('auth.confirm_password')" />
                    <div class="relative">
                        <input id="password_confirmation" class="block mt-1 w-full pr-10"
                            :type="show ? 'text' : 'password'" name="password_confirmation" required
                            autocomplete="new-password">

                        <!-- Icona -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                            @click="show = !show">
                            <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                        </div>
                    </div>
                </div>

                <div class="my-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('auth.already_registered') }}
                    </a>
                </div>

                <button type="submit" :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full">
                    {{ __('auth.register') }}
                </button>
            </form>
        </div>
    </div>
</x-layout>
