<x-layout>
    <x-slot name="title">Homepage</x-slot>
    <div>
        {{-- <div class="grid gap-4 grid-cols-[repeat(auto-fit,_minmax(100px,_1fr))] py-5">
            @for ($i = 0; $i < 10; $i++)
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 rounded">categoria</button>
            @endfor
        </div> --}}
        {{-- <x-filtri.welcome :categories="$categories"></x-filtri.welcome> --}}
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 flex">
            @forelse ($announcements as $announcement)
                <x-card :announcement="$announcement" />
            @empty
                <p class="text-center">Nessun annuncio trovato.</p>
            @endforelse
        </div>
    </div>
</x-layout>
