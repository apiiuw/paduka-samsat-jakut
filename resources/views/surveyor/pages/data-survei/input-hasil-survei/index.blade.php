@extends('surveyor.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7]" x-data="formHandler()">
    <div class="p-4 mt-24">
        <div class="bg-white shadow rounded-lg p-6 text-sm">
            <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">
                <span><i class="fa-solid fa-square-plus fa-lg mr-2"></i></span>Input Data Survei
            </h2>
            <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

            <form class="space-y-4" method="POST" action="{{ route('surveyor.hasil-survei.store') }}" enctype="multipart/form-data" onsubmit="return confirm('Yakin menyimpan data?')">
                @csrf

                <input type="hidden" name="laporan_id" value="{{ $data->id }}">

                <!-- Form Data Laporan -->
                <div>
                    <label class="block text-sm font-medium">Nama Surveyor</label>
                    <input name="nama_surveyor" type="text" placeholder="Ketikkan Nama Surveyor..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Loket Surveyor</label>
                    <input name="loket_surveyor" type="text" placeholder="Ketikkan Loket Surveyor..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Nama Pemilik KBM</label>
                    <input name="nama_pemilik_kbm" type="text" placeholder="Ketikkan Nama Pemilik KBM..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Nomor Polisi KBM</label>
                    <input name="nopol_kbm" type="text" value="{{ $data->nomor_polisi }}" readonly placeholder="Ketikkan Nomor Polisi KBM..." class="placeholder:text-gray-500 cursor-not-allowed placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Jenis KBM</label>
                    <select class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-700 cursor-not-allowed"
                            disabled>
                        <option value="">Pilih Jenis KBM</option>
                        <option value="Roda 2" {{ $data->jenis_kendaraan == 'Roda 2' ? 'selected' : '' }}>Roda 2</option>
                        <option value="Roda 3" {{ $data->jenis_kendaraan == 'Roda 3' ? 'selected' : '' }}>Roda 3</option>
                        <option value="Roda 4" {{ $data->jenis_kendaraan == 'Roda 4' ? 'selected' : '' }}>Roda 4</option>
                        <option value="Diatas Roda 4" {{ $data->jenis_kendaraan == 'Diatas Roda 4' ? 'selected' : '' }}>Diatas Roda 4</option>
                    </select>
                    <input type="hidden" name="jenis_kbm" value="{{ $data->jenis_kendaraan }}">
                </div>

                <div class="bg-white shadow rounded-lg p-6 text-sm mt-10">
                    <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">
                        <span><i class="fa-solid fa-clipboard-list fa-lg mr-2"></i></span>Pertanyaan Survei
                    </h2>
                    <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

                    <div class="bg-gray-300 p-4 rounded-lg shadow-sm mb-6 space-y-4">

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Apakah anda pemilik KBM dengan nomor polisi (nomor polisi)?
                            </label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pertanyaan_1" value="Iya" class="form-radio text-blue-600 mr-2">
                                    <span>Iya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pertanyaan_1" value="Tidak" class="form-radio text-blue-600 mr-2">
                                    <span>Tidak</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Apakah anda bersedia untuk melakukan pelunasan PKB/SW?
                            </label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pertanyaan_2" value="Bersedia" class="form-radio text-blue-600 mr-2"
                                        onchange="togglePertanyaan3(this)">
                                    <span>Bersedia</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pertanyaan_2" value="Tidak Bersedia" class="form-radio text-blue-600 mr-2"
                                        onchange="togglePertanyaan3(this)">
                                    <span>Tidak Bersedia</span>
                                </label>
                            </div>
                        </div>

                        <div id="pertanyaan-3" class="mt-4 hidden">
                            <label class="block text-sm font-medium mb-2">
                                Apakah anda bersedia untuk mengajukan penghapusan data KBM milik anda?
                            </label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pertanyaan_3" value="Bersedia" class="form-radio text-blue-600 mr-2">
                                    <span>Bersedia</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pertanyaan_3" value="Tidak Bersedia" class="form-radio text-blue-600 mr-2">
                                    <span>Tidak Bersedia</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Foto Pemilik KBM</label>
                            <input name="foto_pemilik_kbm" type="file" accept="image/*" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded py-1 bg-white">
                        </div>

                    </div>

                </div>

                <div class="pt-4 flex justify-center">
                    <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">Simpan Hasil Survei</button>
                </div>

            </form>
        </div>
    </div>
</div>

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

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
        <strong>Terjadi kesalahan saat menyimpan data:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    function togglePertanyaan3(radio) {
        const pertanyaan3 = document.getElementById('pertanyaan-3');
        if (radio.value === 'Tidak Bersedia') {
            pertanyaan3.classList.remove('hidden');
        } else {
            pertanyaan3.classList.add('hidden');
            // Optional: Reset pilihan jika pertanyaan 3 disembunyikan
            const radios = pertanyaan3.querySelectorAll('input[type="radio"]');
            radios.forEach(r => r.checked = false);
        }
    }
</script>

@endsection