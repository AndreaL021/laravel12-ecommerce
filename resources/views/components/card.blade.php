@props(['announcement'])

@php
    $images = $announcement->images;
    $categories = $announcement->categories ?? [];
    $user = $announcement->user ?? [];
@endphp

<a href="{{ $announcement->user->id == auth()->user()?->id ? route('announcement.edit', compact('announcement')) : route('show', compact('announcement')) }}"
    style="text-decoration: none">
    <div class="w-full h-full rounded-xl overflow-hidden shadow-lg flex flex-col">

        <!-- SLIDER -->
        <div x-data="{
            index: 0,
            startX: 0,
            endX: 0,
            swipeStart(e) {
                this.startX = e.touches[0].clientX;
            },
            swipeEnd(e) {
                this.endX = e.changedTouches[0].clientX;
                let diff = this.endX - this.startX;
        
                if (Math.abs(diff) > 50) {
                    if (diff < 0) {
                        this.index = (this.index + 1) % {{ $images->count() }};
                    } else {
                        this.index = (this.index - 1 + {{ $images->count() }}) % {{ $images->count() }};
                    }
                }
            }
        }" class="relative w-full h-48 overflow-hidden" @touchstart="swipeStart"
            @touchend="swipeEnd">

            @foreach ($images as $i => $img)
                <img x-show="index === {{ $i }}" src="{{ asset('storage/' . $img->path) }}"
                    class="absolute inset-0 w-full h-48 object-cover transition-all duration-300"
                    alt="Immagine {{ $i + 1 }}">
            @endforeach

            @if ($images->count() > 1)
                <!-- Prev -->
                <button type="button"
                    @click.stop.prevent="index = (index - 1 + {{ $images->count() }}) % {{ $images->count() }}"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-1 shadow flex justify-center items-center">
                    ‹
                </button>
                <!-- Next -->
                <button type="button" @click.stop.prevent="index = (index + 1) % {{ $images->count() }}"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-1 shadow">
                    ›
                </button>
            @endif
        </div>

        <!-- Info -->
        <div class="px-4 py-2">
            <div class="font-bold flex justify-between items-center">
                {{ $user->name }}
                <img class="w-10 h-10 object-cover rounded-full"
                    src="{{ $user->img ? asset('storage/' . $user->img) : asset('images/user.png') }}"
                    alt="{{ $user->name }}">
            </div>
            <div class="font-bold text-xl mb-2 flex justify-between items-center">
                <div>{{ $announcement->title }}</div>
                <div>€ {{ number_format($announcement->price, 2, ',', '.') }}</div>
            </div>
        </div>

        <!-- Categorie -->
        <div class="px-4 pb-2">
            @foreach ($categories as $category)
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                    #{{ __($category->name) }}
                </span>
            @endforeach
        </div>
    </div>
</a>
