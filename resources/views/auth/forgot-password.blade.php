<x-layout>
    <x-slot name="title">Recover Password</x-slot>
    <div class="flex items-center text-center justify-center mt-5">
        <div class="w-full md:w-1/2 mx-3">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 whitespace-pre-line">
                {{ __('auth.forgot_your_password') }}
            </div>


            <form method="POST" action="{{ route('password.email') }}" @submit="loading = true">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="email" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full"
                        :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                        {{ __('auth.reset_link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
