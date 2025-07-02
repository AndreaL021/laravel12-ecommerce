<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title }}</title>

</head>

<body class="bg-gray-100 min-h-screen antialiased" x-data="{ loading: false }">
    <!-- Spinner Overlay (gestito da Alpine) -->
    <div id="loading-spinner" class="loading-spinner" x-show="loading" x-transition
        class="flex items-center justify-center min-h-screen min-w-screen">
        <div class="spinner"></div>
    </div>

    <x-navbar />


    <div class="min-h-screen pt-28 sm:pt-20 md:pt-16 lg:pt-14">
        <!-- Session Status -->
        <x-snackbar :status="session('status')" :title="__(session('title'))" :message="__(session('message'))" />
        <!-- Error Snackbar -->
        @if ($errors->any())
            @php
                $errorList = '<ul class="list-disc list-inside">';
                foreach ($errors->all() as $error) {
                    $errorList .= '<li>' . e(__($error)) . '</li>';
                }
                $errorList .= '</ul>';
            @endphp

            <x-snackbar :status="'error'" :message="$errorList" :title="__('validation.error')" :validation="true" />
        @endif

        {{ $slot }}
    </div>

</body>

</html>
