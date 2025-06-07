@extends('auth.layouts.main')
@section('container')

<div class="relative bg-cover bg-center min-h-screen flex flex-col items-center justify-center" style="background-image: url('/img/background/bg-sign-in.png')">

    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black bg-opacity-60 z-0"></div>

    <!-- Logo Sampingan (Kiri dan Kanan) -->
    <div class="relative z-10 flex justify-center items-center space-x-4 mb-6">
        <img src="/img/jasa-raharja/logo/logo-paduka.png" alt="Logo Paduka" class="h-20 object-contain shadow-md">
        <img src="/img/unit-laka-samsat/logo/logo-samsat.png" alt="Logo Polisi" class="h-20 object-contain shadow-md">
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm z-10">
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