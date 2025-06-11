<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  
        <title>Jasa Raharja | PADUKA</title>
        <link rel="icon" href="{{ asset('img/jasa-raharja/logo/logo-paduka.png') }}">

        {{-- CDN --}}
        <script src="https://kit.fontawesome.com/d7833bfda5.js" crossorigin="anonymous"></script>

        {{-- FONT --}}
        <link href="https://fonts.cdnfonts.com/css/neck-l-sans" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/new-sosis" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/comiccomoc" rel="stylesheet">

        {{-- ICON --}}
        <script src="https://kit.fontawesome.com/d7833bfda5.js" crossorigin="anonymous"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-jakartaSans antialiased overflow-x-hidden">
        @include('surveyor.partials.navbar')
        @include('surveyor.partials.sidebar')
        @yield('container')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>