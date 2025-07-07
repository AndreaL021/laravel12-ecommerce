<x-layout>
    <x-slot name="title">Announcements</x-slot>
    <div>
        <div class="flex justify-center items-center">
            <form action="{{ route('announcement.create') }}" method="get" @submit="loading = true">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 mt-5 px-12 rounded">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </form>
        </div>
        {{-- <div class="grid gap-4 grid-cols-[repeat(auto-fit,_minmax(100px,_1fr))] py-5">
            @for ($i = 0; $i < 10; $i++)
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 rounded">categoria</button>
            @endfor
        </div> --}}
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 flex">
            @forelse ($announcements as $announcement)
                <x-card :announcement="$announcement" />
            @empty
                <p class="text-center">Nessun annuncio trovato.</p>
            @endforelse
        </div>
    </div>
</x-layout>
