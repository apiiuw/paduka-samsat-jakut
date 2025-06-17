@extends('unit-laka-samsat-jakut.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7]">
   <div class="p-4 mt-24">
   <div class="bg-white shadow rounded-lg p-6 text-sm">
      <h2 class="text-lg font-semibold mb-4 text-[#373A3C]"><span><i class="fa-solid fa-square-plus fa-lg mr-2"></i></span>Input Data Kendaraan</h2>
      <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

      <form class="space-y-4" method="POST" action="{{ route('data-kendaraan.store') }}" enctype="multipart/form-data" onsubmit="return confirm('Yakin menyimpan data?')">
      @csrf

         <div>
         <label class="block text-sm font-medium">Laporan Polisi</label>
         <input name="laporan_polisi" type="text" placeholder="Ketikkan Laporan Polisi..." class="placeholder:text-gray-500 placeholder:normal-case uppercase mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
         </div>

         <div>
         <label class="block text-sm font-medium">Tanggal Laporan</label>
         <input name="tanggal_laporan" type="date" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
         </div>

         <div>
         <label class="block text-sm font-medium">Nama Korban</label>
         <input name="nama_korban" type="text" placeholder="Ketikkan Nama Korban..." class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Nama Tersangka</label>
         <input name="nama_tersangka" type="text" placeholder="Ketikkan Nama Tersangka..." class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Jenis Kendaraan</label>
         <select name="jenis_kendaraan" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
            <option value="">Pilih Jenis Kendaraan</option>
            <option value="Roda 2">Roda 2</option>
            <option value="Roda 3">Roda 3</option>
            <option value="Roda 4">Roda 4</option>
            <option value="Diatas Roda 4">Diatas Roda 4</option>
         </select>
         </div>

         <div>
         <label class="block text-sm font-medium">Nomor Polisi</label>
         <input name="nomor_polisi" type="text" placeholder="Ketikkan Nomor Polisi..." class="placeholder:text-gray-500 placeholder:normal-case uppercase mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Masa Berlaku PKB/SW</label>
         <input name="masa_berlaku_pkb_sw" type="date" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
         </div>

         <div>
         <label class="block text-sm font-medium">Total Kerugian</label>
         <input name="total_kerugian" type="text" id="kerugian" placeholder="Rp" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <script>
         document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('kerugian');

            input.addEventListener('input', function (e) {
               let value = input.value.replace(/[^0-9]/g, ''); // Hanya angka
               if (value) {
               value = new Intl.NumberFormat('id-ID').format(value); // Format dengan titik
               input.value = 'Rp ' + value;
               } else {
               input.value = '';
               }
            });

            input.addEventListener('focus', function () {
               // Hapus Rp saat fokus jika ingin ubah
               input.value = input.value.replace(/[^\d]/g, '');
            });

            input.addEventListener('blur', function () {
               // Tambah Rp lagi saat keluar dari input
               let value = input.value.replace(/[^0-9]/g, '');
               if (value) {
               input.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
               }
            });
         });
         </script>

         <div>
         <label class="block text-sm font-medium">Kode Penyidik</label>
         <select name="kode_penyidik" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
            <option value="">Pilih Kode Penyidik</option>
            <option value="T.1">T.1</option>
            <option value="T.2">T.2</option>
            <option value="T.3">T.3</option>
            <option value="T.4">T.4</option>
            <option value="T.5">T.5</option>
            <option value="T.6">T.6</option>
            <option value="T.7">T.7</option>
            <option value="T.8">T.8</option>
            <option value="T.9">T.9</option>
            <option value="T.10">T.10</option>
         </select>
         </div>

         <div>
         <label class="block text-sm font-medium">Foto Barang Bukti</label>
         <input name="foto_barang_bukti" type="file" accept="image/*" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Keterangan</label>
         <textarea name="keterangan" placeholder="Ketikkan Keterangan..." class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2"></textarea>
         </div>

         <div>
         <label class="block text-sm font-medium">Status Perkara</label>
         <select name="status_perkara" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
            <option value="">Pilih Status Perkara</option>
            <option value="Selesai">Selesai</option>
            <option value="Belum Selesai">Belum Selesai</option>
         </select>
         </div>

         <div class="pt-4 flex justify-center">
            <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">Simpan Data</button>
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
@endif

@endsection