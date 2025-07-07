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


            <!-- Immagini già caricate -->
            @if ($announcement->images->count())
                <div class="mt-4">
                    <p class="font-semibold mb-2">Immagini attuali:</p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach ($announcement->images as $image)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $image->path) }}"
                                    class="rounded shadow w-full h-32 object-cover" alt="Immagine annuncio">

                                <!-- Pulsante di eliminazione -->
                                <form method="POST" action="{{ route('images.destroy', $image) }}"
                                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition"
                                    onsubmit="return confirm('Sei sicuro di voler eliminare questa immagine?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Elimina">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <form method="POST" action="{{ route('announcement.update', compact('announcement')) }}"
                @submit="loading = true" enctype="multipart/form-data">
                @csrf
                @method('put')
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
                    <input id="title" class="block w-full" name="title" value="{{ $announcement->title }}"
                        required autofocus>
                </div>

                <!-- des -->
                <div class="mt-4">
                    <x-input-label for="des" :value="__('announcement.des')" />
                    <textarea id="des" class="block w-full" name="des" required>{{ $announcement->des }}</textarea>
                </div>

                <!-- price -->
                <div class="mt-4">
                    <x-input-label for="price" :value="__('announcement.price')" />
                    <input id="price" type="number" value="{{ $announcement->price }}" class="block w-full"
                        name="price">
                </div>

                <!-- categorie -->
                <div class="mt-4">
                    <x-select :selectedItems="$announcement->categories->map(fn($c) => ['id' => $c->id, 'name' => __($c->name)])" label="{{ __('announcement.categories') }}" :items="$categories_items"
                        name="categories" multiple></x-select>
                </div>

                <!-- Bottone -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mt-4"
                    :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    {{ __('announcement.save') }}
                </button>

            </form>
            <!-- Elimina annuncio -->
            <form method="POST" action="{{ route('announcement.destroy', $announcement) }}" class="mt-4"
                onsubmit="return confirm('Sei sicuro di voler eliminare questo annuncio?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded w-full">
                    {{ __('announcement.delete') }}
                </button>
            </form>

        </div>
    </div>

</x-layout>
