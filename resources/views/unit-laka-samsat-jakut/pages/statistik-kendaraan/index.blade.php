@extends('unit-laka-samsat-jakut.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7] min-h-screen">
   <div class="p-4 mt-24">

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
         <!-- Total Data Kendaraan -->
         <div class="bg-blueJR text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Data Kendaraan</p>
                  <p class="text-2xl font-bold">{{ $totalData }}</p>
            </div>
            <div class="text-6xl">
                  <i class="fa-solid fa-car"></i>
            </div>
         </div>

         <!-- Total Perkara Selesai -->
         <div class="bg-green-600 text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Perkara Selesai</p>
                  <p class="text-2xl font-bold">{{ $totalSelesai }}</p>
            </div>
            <div class="text-6xl">
                  <i class="fas fa-briefcase"></i>
            </div>
         </div>

         <!-- Total Perkara Belum Selesai -->
         <div class="bg-red-600 text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Perkara Belum Selesai</p>
                  <p class="text-2xl font-bold">{{ $totalBelumSelesai }}</p>
            </div>
            <div class="text-6xl">
                  <i class="fa-solid fa-business-time"></i>
            </div>
         </div>
      </div>

      <div class="bg-white w-full rounded-xl shadow-md p-6 my-5">
         <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Grafik Data Kendaraan</h2>
            <select name="tahun" onchange="this.form.submit()" class="border border-gray-300 text-sm rounded-md p-2">
               @foreach ($daftarTahun as $item)
                  <option value="{{ $item }}" {{ $item == $tahun ? 'selected' : '' }}>{{ $item }}</option>
               @endforeach
            </select>
         </div>

         <hr class="bg-[#E8EEF2] h-[2px] my-4">

         <!-- Tempat untuk grafik nantinya -->
         <div class="h-64 bg-gray-100 flex items-center justify-center text-gray-400">
            <canvas id="grafikKendaraan" height="100"></canvas>

            <script>
               const ctx = document.getElementById('grafikKendaraan').getContext('2d');

               new Chart(ctx, {
                  type: 'line',
                  data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                           label: 'Jumlah Data Kendaraan',
                           data: @json($dataGrafik),
                           borderColor: '#006AB2',
                           backgroundColor: 'rgba(37, 99, 235, 0.2)',
                           borderWidth: 2,
                           fill: true,
                           tension: 0.4, // Untuk garis melengkung
                           pointRadius: 5,
                           pointBackgroundColor: '#006AB2'
                        }]
                  },
                  options: {
                        responsive: true,
                        plugins: {
                           legend: {
                              display: true,
                              position: 'top'
                           },
                           tooltip: {
                              callbacks: {
                                    label: function(context) {
                                       return 'Jumlah: ' + Math.round(context.parsed.y);
                                    }
                              }
                           }
                        },
                        scales: {
                           y: {
                              beginAtZero: true,
                              ticks: {
                                    // Tampilkan angka bulat saja
                                    callback: function(value) {
                                       return Number.isInteger(value) ? value : '';
                                    },
                                    precision: 0 // Tidak pakai koma
                              }
                           }
                        }
                  }
               });
            </script>


         </div>

         <div class="flex justify-center mt-4">
            <form method="GET" action="{{ route('statistik-kendaraan.download') }}">
               <input type="hidden" name="tahun" value="{{ $tahun }}">
               <button class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">
                  Unduh Laporan
               </button>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection