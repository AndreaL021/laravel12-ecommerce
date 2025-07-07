<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile.update_password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile.ensure') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" @submit="loading = true">
        @csrf
        @method('put')

        <div x-data="{ show: false }">
            <x-input-label for="update_password_current_password" :value="__('profile.current_password')" />
            <div class="relative">
                <input id="update_password_current_password" :type="show ? 'text' : 'password'" name="current_password"
                    type="password" class="mt-1 block w-full" autocomplete="current-password">

                <!-- Icona -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                    @click="show = !show">
                    <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                </div>
            </div>
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password" :value="__('profile.new_password')" />
            <div class="relative">
                <input id="update_password_password" :type="show ? 'text' : 'password'" name="password" type="password"
                    class="mt-1 block w-full" autocomplete="new-password">

                <!-- Icona -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                    @click="show = !show">
                    <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                </div>
            </div>
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password_confirmation" :value="__('profile.confirm_password')" />
            <div class="relative">
                <input id="update_password_password_confirmation" :type="show ? 'text' : 'password'"
                    name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password">

                <!-- Icona -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
                    @click="show = !show">
                    <i :class="show ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 w-full sm:w-auto px-8 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ __('profile.save') }}</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('profile.saved.') }}</p>
            @endif
        </div>
    </form>
</section>
