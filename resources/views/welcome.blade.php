<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>To-Do Hero</title>
    <!-- Icon -->
    <link rel="icon" href="/favicon48x48.png" sizes="48x48" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased">
    @if (Route::has('login'))
        <header class="header-home">
            <div class="header-logo">
                <a href="/"><img src="images/logo.png" alt="">To-Do Hero</a>
            </div>
            <div class="header-options">
                <div class="container-options">
                    <ul>
                        <li><a href="javascript:void(0);">Nosotros</a></li>  {{-- terminar --}}
                    </ul>
                    <div class="divider-header"></div>
                    <ul>
                        @auth
                            <li><a href="{{ url('/dashboard') }}"
                                    class="btn-back-to-task text-sm text-gray-700 dark:text-gray-500 underline">Mis tareas
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    @else
                                    @endif
                                </a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500">Iniciar
                                    sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="box-btn-register"><a href="{{ route('register') }}" class="btn-register">Pruébala
                                        gratis</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
                <div class="bar-menu">
                    <span class="line-bar-1"></span>
                    <span class="line-bar-2"></span>
                    <span class="line-bar-3"></span>
                </div>
            </div>
        </header>
    @endif

    <main class="section-lg">
        <section class="section-hero">
            <div class="container-hero">
                <div class="container-text">
                    <h1>Organiza tu<br>
                        trabajo y tu vida, por fin.</h1>
                    <h2>Concéntrate, organízate y trae calma a tu vida con To-Do Hero. La aplicación de listas de
                        pendientes y
                        gestión
                        de tareas n.º 1 del mundo.</h2>
                    @auth
                        <a href="{{ url('/tareas') }}">Ver mis tareas</a>
                    @else
                        <a href="{{ route('register') }}">Pruébala gratis</a>
                    @endauth
                </div>

                <div class="banner-image">
                    <img src="./images/banner-1.gif" alt="">
                </div>

            </div>
        </section>
    </main>
</body>

</html>
