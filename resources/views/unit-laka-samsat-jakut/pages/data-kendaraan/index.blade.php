@extends('unit-laka-samsat-jakut.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7] min-h-screen">
   <div class="p-4 mt-24">

   <div class="bg-white p-4 rounded-xl shadow-md">
      <p class="font-semibold text-lg text-[#373A3C]">Filter Data Kendaraan</p>
      <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">
      <div class="flex justify-between flex-wrap gap-2">
         
         <!-- Tahun -->
         <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">Tahun</span>
            <select class="border border-gray-300 rounded px-3 py-1 text-sm">
            <option>2025/2026</option>
            <option>2024/2025</option>
            </select>
         </div>

         <!-- Bulan -->
         <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">Bulan</span>
            <select class="border border-gray-300 rounded px-3 py-1 text-sm">
            <option>Januari</option>
            <option>Februari</option>
            <option>Maret</option>
            <option>April</option>
            <option>Mei</option>
            <option>Juni</option>
            <option>Juli</option>
            <option>Agustus</option>
            <option>September</option>
            <option>Oktober</option>
            <option>November</option>
            <option>Desember</option>
            </select>
         </div>

         <!-- Jenis Kendaraan -->
         <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">Jenis Kendaraan</span>
            <select class="border border-gray-300 rounded px-3 py-1 text-sm">
            <option>Roda 2</option>
            <option>Roda 4</option>
            <option>Diatas Roda 4</option>
            </select>
         </div>

         <!-- Status Perkara -->
         <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">Status Perkara</span>
            <select class="border border-gray-300 rounded px-3 py-1 text-sm">
            <option>Selesai</option>
            <option>Belum Selesai</option>
            </select>
         </div>
      </div>
   </div>

   <div class="mx-auto bg-white p-6 rounded-xl shadow-md mt-8">
    <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">Data Kendaraan</h2>

    <hr class="bg-[#E8EEF2] h-[2px] my-4">

    <!-- Search -->
    <div class="flex items-center gap-2 mb-4 text-sm">
      <input type="text" placeholder="Ketikkan Nomor Laporan" class="w-full border text-sm rounded px-4 py-2" />
      <button class="bg-blueJR text-white px-4 py-2 rounded whitespace-nowrap">Cari Data</button>
    </div>

    <!-- Table -->
   <div class="overflow-x-auto w-full">
   <table class="min-w-[1500px] border text-sm text-left">
      <thead class="bg-[#373D53] text-white text-center">
         <tr>
         <th class="border px-2 py-1">No</th>
         <th class="border px-2 py-1">Laporan Polisi</th>
         <th class="border px-2 py-1">Tanggal Laporan</th>
         <th class="border px-2 py-1">Nama Korban</th>
         <th class="border px-2 py-1">Nama Tersangka</th>
         <th class="border px-2 py-1">Jenis Kendaraan</th>
         <th class="border px-2 py-1">Nomor Polisi</th>
         <th class="border px-2 py-1">Masa Berlaku PKB/SW</th>
         <th class="border px-2 py-1">Total Kerugian</th>
         <th class="border px-2 py-1">Kode Penyidik</th>
         <th class="border px-2 py-1">Foto Barang Bukti</th>
         <th class="border px-2 py-1">Keterangan</th>
         <th class="border px-2 py-1">Status Perkara</th>
         </tr>
      </thead>
      <tbody class="bg-white">
         <tr class="border-t text-center">
            <td class="border px-2 py-1">1</td>
            <td class="border px-2 py-1 whitespace-nowrap">LP/1432/S/VI/2025</td>
            <td class="border px-2 py-1">01/06/2025</td>
            <td class="border px-2 py-1">Nurhasan</td>
            <td class="border px-2 py-1">Nurhasan</td>
            <td class="border px-2 py-1">Roda 2</td>
            <td class="border px-2 py-1 whitespace-nowrap">B 8421 TKM</td>
            <td class="border px-2 py-1">24/12/2027</td>
            <td class="border px-2 py-1">Rp10.000.000</td>
            <td class="border px-2 py-1">T.4</td>
            <td class="border px-2 py-1 flex justify-center">
               <img src="https://via.placeholder.com/50" class="w-12 h-12 object-cover rounded" />
            </td>
            <td class="border px-2 py-1">Tersangka menabrak dan menaiki trotoar</td>
            <td class="border px-2 py-1 text-green-600 font-semibold">Selesai</td>
         </tr>
         <tr class="border-t text-center">
            <td class="border px-2 py-1">2</td>
            <td class="border px-2 py-1 whitespace-nowrap">LP/1432/S/VI/2025</td>
            <td class="border px-2 py-1">01/06/2025</td>
            <td class="border px-2 py-1">Nurhasan</td>
            <td class="border px-2 py-1">Nurhasan</td>
            <td class="border px-2 py-1">Roda 2</td>
            <td class="border px-2 py-1 whitespace-nowrap">B 8421 TKM</td>
            <td class="border px-2 py-1">24/12/2027</td>
            <td class="border px-2 py-1">Rp10.000.000</td>
            <td class="border px-2 py-1">T.4</td>
            <td class="border px-2 py-1 flex justify-center">
               <img src="https://via.placeholder.com/50" class="w-12 h-12 object-cover rounded" />
            </td>
            <td class="border px-2 py-1">Tersangka menabrak dan menaiki trotoar</td>
            <td class="border px-2 py-1 text-red-600 font-semibold">Belum Selesai</td>
         </tr>
      </tbody>
   </table>
   </div>


    <!-- Pagination -->
    <div class="flex flex-col justify-center items-center mt-4">
      <div class="mb-4">
        <button class="px-3 py-1 border rounded bg-gray-200 mr-1">Previous</button>
        <button class="px-3 py-1 border rounded bg-white">1</button>
        <button class="px-3 py-1 border rounded bg-blueJR text-white">2</button>
        <button class="px-3 py-1 border rounded bg-white">3</button>
        <button class="px-3 py-1 border rounded bg-white">4</button>
        <button class="px-3 py-1 border rounded bg-white">5</button>
        <button class="px-3 py-1 border rounded bg-gray-200 ml-1">Next</button>
      </div>

      <button class="bg-blueJR text-white px-6 py-2 rounded">Unduh Data</button>
    </div>
  </div>



   </div>
</div>


@endsection