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

            <!-- Form di aggiornamento -->
            <form method="POST" action="{{ route('announcement.update', compact('announcement')) }}"
                enctype="multipart/form-data" @submit="loading = true" x-data="{
                    previews: [],
                    max: 5,
                    imagesToDelete: [],
                    existingImages: @js($announcement->images),
                
                    handleFiles(event) {
                        const files = Array.from(event.target.files);
                        const total = files.length + this.visibleExistingImages.length;
                        if (total > this.max) {
                            alert('{{ __('announcement.max5') }}');
                            event.target.value = '';
                            return;
                        }
                        this.previews = files.map(file => ({
                            name: file.name,
                            url: URL.createObjectURL(file),
                            file: file
                        }));
                    },
                
                    removePreview(index) {
                        this.previews.splice(index, 1);
                
                        const dataTransfer = new DataTransfer();
                        this.previews.forEach(p => dataTransfer.items.add(p.file));
                        $refs.imagesInput.files = dataTransfer.files;
                    },
                
                    toggleDelete(id) {
                        this.imagesToDelete.push(id);
                    },
                
                    isDeleted(id) {
                        return this.imagesToDelete.includes(id);
                    },
                
                    get visibleExistingImages() {
                        return this.existingImages.filter(img => !this.isDeleted(img.id));
                    }
                }">

                @csrf
                @method('put')

                <!-- Galleria immagini vecchie -->
                <template x-if="visibleExistingImages.length">
                    <div class="mt-4">
                        <p class="font-semibold mb-2">{{ __('announcement.current_images') }}</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <template x-for="img in visibleExistingImages" :key="img.id">
                                <div class="relative group">
                                    <img :src="'/storage/' + img.path" class="rounded shadow w-full h-32 object-contain"
                                        alt="Immagine annuncio">
                                    <button type="button" @click="if (confirm('{{ __('announcement.delete_images') }}')) toggleDelete(img.id)"
                                        class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                            </template>
                            <!-- Input nascosti solo per immagini da eliminare -->
                            <template x-for="id in imagesToDelete" :key="'delete-' + id">
                                <input type="hidden" name="delete_images[]" :value="id">
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Input immagini nuove -->
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
                            <button type="button" @click="if (confirm('{{ __('announcement.delete_images') }}')) removePreview(index)"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1">
                                <i class="fa-solid fa-x"></i>
                            </button>
                        </div>
                    </template>
                </div>

                <!-- Titolo -->
                <div class="mt-4">
                    <x-input-label for="title" :value="__('announcement.title')" />
                    <input id="title" class="block w-full" name="title" value="{{ $announcement->title }}"
                        required autofocus>
                </div>

                <!-- Descrizione -->
                <div class="mt-4">
                    <x-input-label for="des" :value="__('announcement.des')" />
                    <textarea id="des" class="block w-full" name="des" required>{{ $announcement->des }}</textarea>
                </div>

                <!-- Prezzo -->
                <div class="mt-4">
                    <x-input-label for="price" :value="__('announcement.price')" />
                    <input id="price" type="number" value="{{ $announcement->price }}" class="block w-full"
                        name="price">
                </div>

                <!-- Categorie -->
                <div class="mt-4">
                    <x-select :selectedItems="$announcement->categories->map(fn($c) => ['id' => $c->id, 'name' => __($c->name)])" label="{{ __('announcement.categories') }}" :items="$categories_items"
                        name="categories" multiple />
                </div>

                <!-- Salva -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mt-4">
                    {{ __('announcement.save') }}
                </button>
            </form>

            <!-- Elimina annuncio -->
            <form method="POST" action="{{ route('announcement.destroy', $announcement) }}" class="mt-4"
                onsubmit="return confirm('{{ __('announcement.delete_confirm') }}')">
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
