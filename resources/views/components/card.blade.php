@props(['announcement'])

@php
    $title = $announcement->title;
    $des = $announcement->des;
    $price = $announcement->price;
    $categories = $announcement->categories ?? [];
    $user = $announcement->user ?? [];
    // $images = $announcement->images ?? [];
     $image = $announcement->images->first()?->path;
@endphp

<div class="w-full h-full min-h-[380px] rounded-xl overflow-hidden shadow-lg flex flex-col">
    <img class="w-full h-48 object-cover" src="{{ $image ? asset('storage/' . $image) :asset('images/user.png') }}" alt="Immagine annuncio">
    <div class="px-4">
        <div class="font-bold flex justify-between items-center">{{ $user->name }} 
            <img class="w-12"  src="{{ $user->img ? asset('storage/' . $user->img) :asset('images/user.png') }}" alt="Nessuna immagine">
        </div>
        <div class="font-bold text-xl mb-2 flex justify-between items-center"><div>{{ $title }} </div><div>${{ $price }} </div>
        </div>
        {{-- <p class="text-gray-700 text-base">
            {{ $des }}
        </p> --}}
    </div>
    <div class="px-4">
        @foreach ($categories as $category)
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ __($category->name) }}</span>
        @endforeach
    </div>
</div>
