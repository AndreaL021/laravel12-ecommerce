@props(['categories'])
<div>
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 flex">
        {{-- <form method="POST" action="{{ route('announcement.filter') }}" @submit="loading = true"> --}}
        @csrf
        <!-- title -->
        {{-- <input id="title" placeholder="{{ __('navbar.search') }}" class="block w-full" name="title"
            value="{{ old('title') }}"> --}}
        <!-- price -->
        {{-- <x-input-label for="price" :value="__('announcement.price')" />
                    <input id="price" type="number" class="block w-full" name="price"> --}}

        <!-- categorie -->
        {{-- :selectedItems="$announcement->categories->map(fn($c) => ['id' => $c->id, 'name' => __($c->name)])" --}}
        <x-select multiple label="{{ __('announcement.categories') }}" :items="$categories" name="categories"></x-select>

        <!-- Bottone -->
        {{-- <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mt-4"
                    :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    {{ __('announcement.save') }}
                </button> --}}

        {{-- </form> --}}
    </div>
</div>
