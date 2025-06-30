<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile.update_password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile.ensure') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('profile.current_password')" />
            <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('profile.new_password')" />
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('profile.confirm_password')" />
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <button>{{ __('profile.save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('profile.saved.') }}</p>
            @endif
        </div>
    </form>
</section>
