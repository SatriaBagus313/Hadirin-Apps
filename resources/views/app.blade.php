<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>hadirin-apps</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/locale/id.min.js"
        integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Header for map display --}}
    @yield('map_header')
    @yield('admin_header')
</head>

<body class="antialiased">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            {{-- @include('includes.navbar') --}}

            {{-- @include('includes.sidebar') --}}

            @yield('navbar')

            @yield('sidebar')

            {{-- @include('includes.footer') --}}

            @yield('content')

            @yield('includes.footer')


        </div>
    </div>

</body>

</html>
