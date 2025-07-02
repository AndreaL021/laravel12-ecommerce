@props(['announcement'])

@php
    $title = $announcement->title;
    $des = $announcement->des;
    $categories = $announcement->categories ?? [];
    // $images = $announcement->images ?? [];
     $image = $announcement->images->first()?->path;
@endphp

<div class="max-w-sm mx-auto rounded-xl overflow-hidden shadow-lg">
    <img class="w-full"  src="{{ $image ? asset('storage/' . $image) :asset('images/user.png') }}" alt="Immagine annuncio">
    <div class="px-4 py-2">
        <div class="font-bold text-xl mb-2">{{ $title }}</div>
        <p class="text-gray-700 text-base">
            {{ $des }}
        </p>
    </div>
    <div class="px-4 pt-2 pb-2">
        @foreach ($categories as $category)
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ __($category->name) }}</span>
        @endforeach
    </div>
</div>
