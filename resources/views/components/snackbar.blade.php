@props(['status' => 'info', 'title' => '', 'message' => '', 'validation' => ''])

@php
    $colors = [
        'success' => ['bg' => 'bg-green-100', 'border' => 'border-green-500', 'text' => 'text-green-700'],
        'error' => ['bg' => 'bg-red-100', 'border' => 'border-red-500', 'text' => 'text-red-700'],
        'warning' => ['bg' => 'bg-yellow-100', 'border' => 'border-yellow-500', 'text' => 'text-yellow-700'],
        'info' => ['bg' => 'bg-blue-100', 'border' => 'border-blue-500', 'text' => 'text-blue-700'],
    ];
    $color = $colors[$status] ?? [
        'bg' => 'bg-orange-100',
        'border' => 'border-orange-500',
        'text' => 'text-orange-700',
    ];
@endphp
@if (!empty($message))
    <div id="snackbar" onclick="closeSnackbar()" style="top: 60px;"
        class="fixed right-4 z-50 {{ $color['bg'] }} {{ $color['border'] }} {{ $color['text'] }} border-l-4 p-4 rounded shadow transition-opacity duration-300 opacity-100"
        role="alert" aria-live="assertive">
        @if (!empty($title))
            <p class="font-bold">{{ __($title) }}</p>
        @endif
        <div>{!! $message !!}</div>
    </div>

    <script>
        const snackbar = document.getElementById('snackbar');

        function closeSnackbar() {
            snackbar.classList.add('opacity-0');
            setTimeout(() => snackbar.remove(), 300);
        }

        setTimeout(closeSnackbar, {{ $validation ? 8000 : 4000 }});
    </script>
@endif
