<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title }}</title>

</head>

<body class="bg-gray-100 min-h-screen antialiased" x-data="{ loading: false }">
    <!-- Spinner Overlay (gestito da Alpine) -->
    <div id="loading-spinner" class="loading-spinner" x-show="loading" x-transition
        class="flex items-center justify-center min-h-screen min-w-screen">
        <div class="spinner"></div>
    </div>


    <div class="min-h-screen pt-14">
<x-navbar />

        {{ $slot }}
    </div>

</body>

</html>
