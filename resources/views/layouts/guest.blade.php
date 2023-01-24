<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | To-Do Hero</title>
    <!-- Icon -->
    <link rel="icon" href="/favicon48x48.png" sizes="48x48" type="image/png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>

<body>
    <header class="header-login">
        <div class="header-logo" title="Regrese a la página de inicio de To-Do Hero.">
            <a href="/"><img src="images/logo.png" alt="Logo To-Do Hero">To-Do Hero</a>
        </div>
    </header>
    <div class="font-sans color-1fx3 antialiased">
        {{ $slot }}
    </div>
</body>

</html>
