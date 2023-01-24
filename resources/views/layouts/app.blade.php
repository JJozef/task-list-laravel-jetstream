<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Icon -->
    <link rel="icon" href="/favicon48x48.png" sizes="48x48" type="image/png">
</head>

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
<!-- Styles -->
@livewireStyles
<link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.3/index.global.min.js"
    integrity="sha256-3ytVDiLNNR0KlhglNHqXDFL94uOszVxoQeU7AZEALYo=" crossorigin="anonymous"></script>
@stack('css')

</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    @stack('js')

    <script>
        Livewire.on('alert', function(message) {
            Swal.fire({
                icon: 'success',
                title: 'Perfecto!',
                html: 'La tarea:' + '<br> <b>' + message + '</b> <br>' + 'Se creo correctamente'
            })
        });
        Livewire.on('alertupdate', function(message) {
            Swal.fire({
                icon: 'success',
                title: 'Perfecto!',
                html: 'La tarea ' + '<b>' + message + '</b>' + ' correctamente'
            })
        });
        Livewire.on('alertcat', function(message) {
            Swal.fire({
                icon: 'success',
                title: 'Perfecto!',
                html: 'La categoría:' + '<br> <b>' + message + '</b> <br>' + 'Se creo correctamente'
            })
        });
        Livewire.on('alertupdatecat', function(message) {
            Swal.fire({
                icon: 'success',
                title: 'Perfecto!',
                html: 'La categoría ' + '<b>' + message + '</b>' + ' correctamente'
            })
        });
        Livewire.on('alertNoDelCat', function(message) {
            Swal.fire({
                icon: 'info',
                title: 'Oppsss!',
                html: message
            })
        });
        Livewire.on('alertYesDelCat', function(message) {
            Swal.fire({
                icon: 'success',
                title: 'Perfecto!',
                html: message
            })
        });
        Livewire.on('commentAdded', () => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Se agregó el comentario.',
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>

</body>

</html>
