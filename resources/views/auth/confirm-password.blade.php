<x-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('auth.secure_area') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" @submit="loading = true">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('auth.password_label')" />

            <input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full"
                :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                {{ __('auth.confirm') }}
            </button>
        </div>
    </form>
</x-layout>
