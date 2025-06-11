@extends('unit-laka-samsat-jakut.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7]">
   <div class="p-4 mt-24">
   <div class="bg-white shadow rounded-lg p-6 text-sm">
      <h2 class="text-lg font-semibold mb-4 text-[#373A3C]"><span><i class="fa-solid fa-square-plus fa-lg mr-2"></i></span>Input Data Kendaraan</h2>
      <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

      <form class="space-y-4">
         <div>
         <label class="block text-sm font-medium">Laporan Polisi</label>
         <input type="text" placeholder="Ketikkan Laporan Polisi..." class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
         </div>

         <div>
         <label class="block text-sm font-medium">Tanggal Laporan</label>
         <input type="date" class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
         </div>

         <div>
         <label class="block text-sm font-medium">Nama Korban</label>
         <input type="text" placeholder="Ketikkan Nama Korban..." class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Nama Tersangka</label>
         <input type="text" placeholder="Ketikkan Nama Tersangka..." class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Jenis Kendaraan</label>
         <select class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
            <option>Pilih Jenis Kendaraan</option>
            <option>Mobil</option>
            <option>Motor</option>
         </select>
         </div>

         <div>
         <label class="block text-sm font-medium">Nomor Polisi</label>
         <input type="text" placeholder="Ketikkan Nomor Polisi..." class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Total Kerugian</label>
         <input type="text" placeholder="Rp" class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Kode Penyidik</label>
         <select class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
            <option>Pilih Kode Penyidik</option>
         </select>
         </div>

         <div>
         <label class="block text-sm font-medium">Foto Barang Bukti</label>
         <input type="file" class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
         </div>

         <div>
         <label class="block text-sm font-medium">Keterangan</label>
         <textarea placeholder="Ketikkan Keterangan..." class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2"></textarea>
         </div>

         <div>
         <label class="block text-sm font-medium">Status Perkara</label>
         <select class="mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
            <option>Pilih Status Perkara</option>
         </select>
         </div>

         <div class="pt-4 flex justify-center">
            <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">Simpan Data</button>
         </div>
      </form>
   </div>
   </div>

</div>


@endsection