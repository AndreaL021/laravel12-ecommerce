<x-layout>
    <x-slot name="title">Homepage</x-slot>
    <div>
        <div class="grid gap-4 grid-cols-[repeat(auto-fit,_minmax(100px,_1fr))] py-5">
            @for ($i = 0; $i < 10; $i++)
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 rounded">categoria</button>
            @endfor
        </div>
        <div class="grid gap-4 grid-cols-[repeat(auto-fit,_minmax(200px,_1fr))] mt-10">
            @for ($i = 0; $i < 20; $i++)
                <x-card />
            @endfor
        </div>

    </div>
    {{-- @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif --}}
</x-layout>
