<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/tabler.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet" type="text/css" />


    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="background-body min-h-screen bg-gray-100 dark:bg-gray-900">

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tabler.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/notiflix/notiflix-3.2.8.min.js') }}"></script>
    <script src="{{ asset('js/notiflix/notiflix-aio-3.2.8.min.js') }}"></script>
    <script src="{{ asset('js/notiflix/notiflix-block-aio-3.2.8.min.js') }}"></script>
    <script src="{{ asset('js/notiflix/notiflix-confirm-aio-3.2.8.min.js') }}"></script>
    <script src="{{ asset('js/notiflix/notiflix-loading-aio-3.2.8.min.js') }}"></script>
    <script src="{{ asset('js/notiflix/notiflix-notify-aio-3.2.8.min.js') }}"></script>
    <script src="{{ asset('js/notiflix/notiflix-report-aio-3.2.8.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/dropzone-min.js') }}"></script>

    @stack('scripts')
</body>

</html>
