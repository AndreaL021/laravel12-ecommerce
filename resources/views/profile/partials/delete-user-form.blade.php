<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile.delete_account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile.once') }}
        </p>
    </header>
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-8 w-full sm:w-auto rounded focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
        {{ __('profile.delete_account') }}
    </button>
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable :title="__('profile.delete_account')">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6" @submit="loading = true">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('profile.sure') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('profile.delete') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('profile.password') }}" class="sr-only" />

                <input id="password" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="{{ __('profile.password') }}" />

            </div>

            <div class="mt-6 flex justify-end">

                <button class="ms-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-8 rounded focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    {{ __('profile.confirm') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
