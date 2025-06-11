@extends('auth.layouts.main')
@section('container')

<div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">

    <!-- YouTube Video Background -->
    <div class="absolute top-0 left-0 w-full h-full -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full">
            <!-- Background Video -->
            <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover -z-10">
                <source src="{{ asset('vid//background/bg-sign-in.mp4') }}" type="video/mp4">
                Browser kamu tidak mendukung video background.
            </video>
        </div>
    </div>

    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>

    <!-- Logo -->
    <div class="relative z-20 flex justify-center items-center space-x-4 mb-6">
        <img src="/img/jasa-raharja/logo/logo-paduka.png" alt="Logo Paduka" class="h-20 object-contain">
        <img src="/img/unit-laka-samsat/logo/logo-samsat.png" alt="Logo Polisi" class="h-20 object-contain">
    </div>

    <!-- Login Box -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm z-20">
        <div class="flex flex-col items-center mb-6">
            <h1 class="text-3xl font-semibold text-center mb-2">Masuk Akun</h1>
            <p class="text-center text-sm text-gray-600">Penghapusan Data Kendaraan Melalui Asuransi Umum Unit Laka Lantas Polri</p>
        </div>

        <form action="" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                       class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 placeholder:text-gray-500"
                       placeholder="Ketikkan Email...">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 placeholder:text-gray-500"
                       placeholder="Ketikkan Password...">
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-blueJR hover:bg-blueJRdark text-white font-semibold px-4 py-2 rounded-md w-full transition">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
