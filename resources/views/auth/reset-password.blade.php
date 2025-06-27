<x-layout>
    <x-slot name="title">Reset Password</x-slot>
    <div class="flex items-center text-center justify-center mt-5">
        <div class="w-full md:w-1/2 mx-3">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.store') }}" @submit="loading = true">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('auth.email')" />
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email', $request->email) }}" required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" :value="__('auth.password_label')" />
                    <div class="relative">
                        <input id="password" class="block mt-1 w-full" :type="show ? 'text' : 'password'"
                            name="password" required autocomplete="new-password">

                        <!-- Icona -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                            @click="show = !show">
                            <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password_confirmation" :value="__('auth.confirm_password')" />
                    <div class="relative">

                        <input id="password_confirmation" class="block mt-1 w-full" :type="show ? 'text' : 'password'"
                            name="password_confirmation" required autocomplete="new-password" />
                        <!-- Icona -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                            @click="show = !show">
                            <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                        </div>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full"
                            :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                            {{ __('auth.reset_password') }}
                        </button>
                    </div>
            </form>
        </div>
    </div>
</x-layout>
