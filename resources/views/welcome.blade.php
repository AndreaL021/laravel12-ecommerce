<x-layout>
    <x-slot name="title">Homepage</x-slot>
    <div>
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 flex">
            @forelse ($announcements as $announcement)
                <x-card :announcement="$announcement" />
            @empty

                <div class="flex items-center justify-center col-span-full py-10">
                    <p class="text-center text-gray-500 text-lg">
                        {{ __('announcement.no_announcement') }}
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
