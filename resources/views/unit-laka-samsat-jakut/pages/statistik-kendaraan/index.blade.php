@extends('unit-laka-samsat-jakut.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7] min-h-screen">
   <div class="p-4 mt-24">

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
         <!-- Total Data Kendaraan -->
         <div class="bg-blueJR text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Data Kendaraan</p>
                  <p class="text-2xl font-bold">145</p>
            </div>
            <div class="text-6xl">
                  <i class="fa-solid fa-car"></i> <!-- Ganti dengan ikon FontAwesome jika ada -->
            </div>
         </div>

         <!-- Total Perkara Selesai -->
         <div class="bg-green-600 text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Perkara Selesai</p>
                  <p class="text-2xl font-bold">30</p>
            </div>
            <div class="text-6xl">
                  <i class="fas fa-briefcase"></i>
            </div>
         </div>

         <!-- Total Perkara Belum Selesai -->
         <div class="bg-red-600 text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Perkara Belum Selesai</p>
                  <p class="text-2xl font-bold">115</p>
            </div>
            <div class="text-6xl">
                  <i class="fa-solid fa-business-time"></i>
            </div>
         </div>
      </div>

      <div class="bg-white w-full rounded-xl shadow-md p-6 my-5">
         <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Grafik Data Kendaraan</h2>
            <select class="border border-gray-300 text-sm rounded-md p-2">
               <option>2025/2026</option>
               <option>2024/2025</option>
               <!-- Tambahkan opsi tahun lainnya di sini -->
            </select>
         </div>

         <hr class="bg-[#E8EEF2] h-[2px] my-4">

         <!-- Tempat untuk grafik nantinya -->
         <div class="h-64 bg-gray-100 flex items-center justify-center text-gray-400">
            Grafik akan ditampilkan di sini
         </div>

         <div class="flex justify-end mt-4">
            <button class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">
               Unduh Laporan
            </button>
         </div>
      </div>
   </div>
</div>

@endsection