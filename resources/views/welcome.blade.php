<x-layout>
    <x-slot name="title">Homepage</x-slot>
    <div>
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 flex">
            @forelse ($announcements as $announcement)
                <x-card :announcement="$announcement" />
            @empty
                <p class="text-center">Nessun annuncio trovato.</p>
            @endforelse
        </div>
    </div>
</x-layout>
