@php
    $categories_items = $categories->map(
        fn($cat) => [
            'id' => $cat['id'],
            'name' => __($cat['name']),
        ],
    );
@endphp
<x-layout>
    <x-slot name="title">Create</x-slot>
    <div class="flex items-center justify-center min-h-[calc(100vh-56px)]">

        <div class="w-full md:w-1/2 mx-3">


            <form method="POST" action="{{ route('announcement.store') }}" @submit="loading = true"
                enctype="multipart/form-data">
                @csrf
                <!-- Immagini -->
                <div class="mt-4">
                    <x-input-label for="images" :value="__('announcement.img')" />
                    <input id="images" type="file" name="images[]" multiple accept="image/*"
                        class="block w-full mt-1">
                    <small class="text-sm text-gray-600">{{ __('announcement.max5') }}</small>
                </div>
                <!-- title -->
                <div>
                    <x-input-label for="title" :value="__('announcement.title')" />
                    <input id="title" class="block w-full" name="title" value="{{ old('title') }}" required
                        autofocus>
                </div>

                <!-- des -->
                <div class="mt-4">
                    <x-input-label for="des" :value="__('announcement.des')" />
                    <textarea id="des" class="block w-full" name="des" required></textarea>
                </div>

                <!-- price -->
                <div class="mt-4">
                    <x-input-label for="price" :value="__('announcement.price')" />
                    <input id="price" type="number" class="block w-full" name="price">
                </div>

                <!-- categorie -->
                <div class="mt-4">
                    <x-select label="{{ __('announcement.categories') }}" :items="$categories_items" name="categories"
                        multiple></x-select>

                </div>

                <!-- Bottone -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mt-4"
                    :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    {{ __('announcement.save') }}
                </button>

            </form>

        </div>
    </div>

</x-layout>
