@extends('user.layouts.main')
@section('container')

<div class="p-4 bg-[#ECF3F7]" x-data="formHandler()">
    <div class="p-4 pt-10">
        <h1 class="text-center font-bold sm:text-md text-xl text-[#373A3C]">FORM PENGAJUAN PENGHAPUSAN DATA KENDARAAN</h1>
        <form class="space-y-4" method="POST" action="{{ route('form-penghapusan-kendaraan') }}" enctype="multipart/form-data" onsubmit="return confirm('Apakah yakin data anda sudah benar?')">
            @csrf  
            <div class="bg-white shadow rounded-lg p-6 text-sm">
                <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">
                    <span><i class="fa-solid fa-user sm:fa-md lg:fa-lg mr-2"></i></span>Identitas Diri
                </h2>
                <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

                <!-- Form Data Laporan -->
                <div class="mb-3">
                    <label class="block text-sm font-medium">Nama Pemilik</label>
                    <input name="nama_pemilik" type="text" placeholder="Ketikkan Nama Pemilik..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Alamat Sesuai Identitas</label>
                    <input name="alamat_sesuai_identitas" type="text" placeholder="Ketikkan Alamat Sesuai Identitas..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">NIK/TDP/NIB/Kitas/Kitab</label>
                    <input name="nik_tdp_nib_kitas_kitab" type="text" placeholder="Ketikkan NIK/TDP/NIB/Kitas/Kitab..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">No. Tlp/HP</label>
                    <input name="no_telp" type="number" value="" placeholder="Ketikkan No. Tlp/HP..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Email</label>
                    <input name="email" type="email" value="" placeholder="Ketikkan Email..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6 text-sm">
                <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">
                    <span><i class="fa-solid fa-car sm:fa-md lg:fa-lg mr-2"></i></span>Identitas Kendaraan
                </h2>
                <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

                <!-- Form Data Laporan -->
                <div class="mb-3">
                    <label class="block text-sm font-medium">NRKB</label>
                    <input name="nrkb_kendaraan" type="text" placeholder="Ketikkan NRKB..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Merek</label>
                    <input name="merek_kendaraan" type="text" placeholder="Ketikkan Merek..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Tipe</label>
                    <input name="tipe_kendaraan" type="text" value="" placeholder="Ketikkan Tipe..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Jenis</label>
                    <input name="jenis_kendaraan" type="text" value="" placeholder="Ketikkan Jenis..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Model</label>
                    <input name="model_kendaraan" type="text" value="" placeholder="Ketikkan Model..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Tahun Pembuatan</label>
                    <input name="tahun_pembuatan_kendaraan" type="number" value="" placeholder="Ketikkan Tahun Pembuatan..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Isi Silinder / Daya Listrik</label>
                    <input name="isi_silinder_daya_listrik_kendaraan" type="text" value="" placeholder="Ketikkan Isi Silinder / Daya Listrik..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Nomor Rangka</label>
                    <input name="nomor_rangka_kendaraan" type="text" value="" placeholder="Ketikkan Nomor Rangka..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Nomor Mesin</label>
                    <input name="nomor_mesin_kendaraan" type="text" value="" placeholder="Ketikkan Nomor Mesin..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Warna Kendaraan Bermotor</label>
                    <input name="warna_kendaraan" type="text" value="" placeholder="Ketikkan Warna Kendaraan Bermotor..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Bahan Bakar / Sumber Energi</label>
                    <input name="bahan_bakar_sumber_energi_kendaraan" type="text" value="" placeholder="Ketikkan Bahan Bakar / Sumber Energi..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Warna TNKB</label>
                    <input name="warna_tnkb_kendaraan" type="text" value="" placeholder="Ketikkan Warna TNKB..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Nomor BPKB</label>
                    <input name="nomor_bpkb_kendaraan" type="text" value="" placeholder="Ketikkan Nomor BPKB..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Alasan permohonan <strong>Penghapusan Regident Ranmor</strong> karena</label>
                    <textarea name="alasan_permohonan" type="text" value="" placeholder="Ketikkan Alasan Permohonan..." class="placeholder:text-gray-500 placeholder:normal-case mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"></textarea>
                </div>

            </div>

            <div class="pt-4 flex justify-center">
                <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">Cetak PDF</button>
            </div>
        </form>
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

@endsection
