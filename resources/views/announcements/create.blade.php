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

            <form method="POST" action="{{ route('announcement.store') }}" enctype="multipart/form-data"
                x-data="{
                    previews: [],
                    max: 5,
                    handleFiles(event) {
                        const files = Array.from(event.target.files);
                        if (files.length > this.max) {
                            alert('{{ __('announcement.max5') }}');
                            event.target.value = '';
                            return;
                        }
                        this.previews = files.map(file => ({
                            name: file.name,
                            url: URL.createObjectURL(file),
                            file: file
                        }));
                
                        // Aggiorna input file
                        const dataTransfer = new DataTransfer();
                        this.previews.forEach(p => dataTransfer.items.add(p.file));
                        $refs.imagesInput.files = dataTransfer.files;
                    },
                    removePreview(index) {
                        this.previews.splice(index, 1);
                        const dataTransfer = new DataTransfer();
                        this.previews.forEach(p => dataTransfer.items.add(p.file));
                        $refs.imagesInput.files = dataTransfer.files;
                    }
                }" @submit="loading = true">
                @csrf

                <!-- Immagini -->
                <div class="mt-4">
                    <x-input-label for="images" :value="__('announcement.img')" />
                    <input id="images" type="file" name="images[]" multiple accept="image/*"
                        class="block w-full mt-1" @change="handleFiles" x-ref="imagesInput">
                    <small class="text-sm text-gray-600">{{ __('announcement.max5') }}</small>
                </div>

                <!-- Galleria anteprime nuove -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4">
                    <template x-for="(preview, index) in previews" :key="preview.name">
                        <div class="relative group">
                            <img :src="preview.url" class="rounded shadow w-full h-32 object-contain"
                                alt="Anteprima">
                            <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs text-center py-1 truncate"
                                x-text="preview.name"></div>
                            <button type="button"
                                @click="if (confirm('{{ __('announcement.delete_images') }}')) removePreview(index)"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1">
                                <i class="fa-solid fa-x"></i>
                            </button>
                        </div>
                    </template>
                </div>

                <!-- title -->
                <div class="mt-4">
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
                        multiple />
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
