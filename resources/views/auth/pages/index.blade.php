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

        <form action="{{ route('signIn') }}" method="POST" class="space-y-4">
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

@if(session('error'))
<div id="toast-danger" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg transition-opacity duration-700 opacity-100">
    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
    <button type="button" onclick="closeErrorToast()" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<script>
    const errorToast = document.getElementById('toast-danger');
    if (errorToast) {
        setTimeout(() => {
            errorToast.classList.remove('opacity-100');
            errorToast.classList.add('opacity-0');
        }, 5000);

        errorToast.addEventListener('transitionend', () => {
            errorToast.remove();
        });
    }

    function closeErrorToast() {
        errorToast.classList.remove('opacity-100');
        errorToast.classList.add('opacity-0');
    }
</script>
@endif

@if(session('success'))
<div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-green-800 bg-green-100 rounded-lg shadow-lg transition-opacity duration-700 opacity-100"
     role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-200 rounded-lg">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 111.414-1.414L8.414 12.586l7.293-7.293a1 1 0 011.414 0z"/>
        </svg>
        <span class="sr-only">Success icon</span>
    </div>
    <div class="ms-3 text-sm font-medium">
        {{ session('success') }}
    </div>
    <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
            onclick="closeToast()">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13"/>
        </svg>
        <span class="sr-only">Close</span>
    </button>
</div>

<script>
    const toast = document.getElementById('toast-success');
    if (toast) {
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
        }, 5000); // 5 detik

        toast.addEventListener('transitionend', () => {
            toast.remove();
        });
    }

    function closeToast() {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
    }
</script>
@endif


@endsection
