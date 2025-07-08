<x-layout>
    <x-slot name="title">Show</x-slot>
    <div class="bg-white shadow-md rounded-2xl overflow-hidden max-w-md mx-auto mt-20">
        <!-- Immagine -->
        <img src="{{ $announcement->images->first()?->path ? asset('storage/' . $announcement->images->first()->path) : asset('images/placeholder.png') }}"
            alt="{{ $announcement->title }}" class="w-full h-48 object-cover">

        <!-- Contenuto -->
        <div class="p-4">
            <!-- Autore e data -->
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-500">
                    {{ __('Inserito da') }}
                    <span class="font-medium text-gray-700">{{ $announcement->user->name }}</span><br>
                    <span class="text-xs">{{ $announcement->created_at->format('d/m/Y') }}</span>
                </div>
                <img class="w-12 h-12 rounded-full object-cover"
                    src="{{ $announcement->user->img ? asset('storage/' . $announcement->user->img) : asset('images/user.png') }}"
                    alt="{{ $announcement->user->name }}">
            </div>

            <!-- Titolo -->
            <h2 class="text-xl font-semibold text-gray-800 mb-1">
                {{ $announcement->title }}
            </h2>

            <!-- Descrizione -->
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{ $announcement->des }}
            </p>

            <!-- Prezzo -->
            <div class="text-right">
                <span class="text-lg font-bold text-indigo-600">
                    € {{ number_format($announcement->price, 2, ',', '.') }}
                </span>
            </div>
        </div>
    </div>
    <div class="mt-10 text-center text-gray-500">
        {{ __('Annunci correlati:') }}
    </div>
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-10 flex">
        @forelse ($announcements as $announcement)
            <x-card :announcement="$announcement" />
        @empty
            <p class="text-center">Nessun annuncio trovato.</p>
        @endforelse
    </div>
</x-layout>
