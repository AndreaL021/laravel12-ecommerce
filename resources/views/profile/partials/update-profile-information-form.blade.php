<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
            {{ __('profile.profile_information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-center">
            {{ __('profile.update') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" @submit="loading = true">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" @submit="loading = true"
        enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="flex items-center justify-center p-2">
            <!-- Input nascosto -->
            <input type="file" id="imageInput" name="img" accept="image/*" class="hidden"
                value="{{ old('img', $user->img) }}" />
            <button type="button" onclick="document.getElementById('imageInput').click()"
                class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <img id="preview" class="w-[200px] rounded-full"
                    src="{{ $user->img ? asset('storage/' . $user->img) : asset('images/user.png') }}" alt="error" />
            </button>
        </div>
        <div>
            <x-input-label for="name" :value="__('profile.name')" />
            <input id="name" name="name" type="text" class="mt-1 block w-full"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
        </div>

        <div>
            <x-input-label for="email" :value="__('profile.email')" />
            <input id="email" name="email" type="email" class="mt-1 block w-full"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('profile.unverified') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('profile.re-send') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('profile.sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 w-full sm:w-auto px-8 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ __('profile.save') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('profile.saved') }}</p>
            @endif
        </div>
    </form>
</section>
<script>
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
</script>
