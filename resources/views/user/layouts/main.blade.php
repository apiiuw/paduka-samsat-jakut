<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Form Pengajuan Penghapusan Data Kendaraan | PADUKA</title>
        <link rel="icon" href="{{ asset('img/jasa-raharja/logo/logo-paduka.png') }}">

        {{-- Custom Open Graph Meta Tags for WhatsApp and Social Sharing --}}
        <meta property="og:title" content="Aplikasi Samsat PADUKA">
        <meta property="og:description" content="Buat pengajuan penghapusan data kendaraanmu dengan mudah dengan aplikasi PADUKA!">
        <meta property="og:image" content="{{ asset('img/jasa-raharja/logo/seo-paduka.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="PADUKA">

        {{-- Twitter Card Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Aplikasi Samsat PADUKA">
        <meta name="twitter:description" content="Buat pengajuan penghapusan data kendaraanmu dengan mudah dengan aplikasi PADUKA!">
        <meta name="twitter:image" content="{{ asset('img/jasa-raharja/logo/seo-paduka.png') }}">
        <meta name="twitter:site" content="@paduka">
        <meta name="twitter:creator" content="@paduka">

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
        @yield('container')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>