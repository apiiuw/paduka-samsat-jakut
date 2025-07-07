@extends('jasa-raharja.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7] min-h-screen">
   <div class="p-4 mt-24">

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
         <!-- Total Laporan -->
         <div class="bg-blueJR text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Laporan</p>
                  <p class="text-2xl font-bold">{{ $totalLaporan }}</p>
            </div>
            <div class="text-6xl">
                  <i class="fa-solid fa-file"></i>
            </div>
         </div>

         <!-- Total Perkara Selesai -->
         <div class="bg-green-600 text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Selesai Survei</p>
                  <p class="text-2xl font-bold">{{ $totalSelesai }}</p>
            </div>
            <div class="text-6xl">
                  <i class="fas fa-briefcase"></i>
            </div>
         </div>

         <!-- Total Perkara Belum Selesai -->
         <div class="bg-red-600 text-white p-5 py-10 rounded-lg shadow-md flex justify-between items-center">
            <div>
                  <p class="text-sm">Total Belum Survei</p>
                  <p class="text-2xl font-bold">{{ $totalBelumSurvei }}</p>
            </div>
            <div class="text-6xl">
                  <i class="fa-solid fa-business-time"></i>
            </div>
         </div>
      </div>

      <div class="bg-white w-full rounded-xl shadow-md p-6 my-5">
         <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Grafik Laporan Masuk</h2>
            <form method="GET" action="{{ route('jr.statistik-laporan.index') }}">
               <select name="tahun" onchange="this.form.submit()" class="border border-gray-300 text-sm rounded-md p-2">
                  <option value="">Semua Tahun</option>
                  @foreach ($daftarTahun as $item)
                     <option value="{{ $item }}" {{ $item == $tahun ? 'selected' : '' }}>{{ $item }}</option>
                  @endforeach
               </select>
            </form>
         </div>

         <hr class="bg-[#E8EEF2] h-[2px] my-4">

         <!-- Tempat untuk grafik -->
         <div class="h-64 bg-gray-100 flex items-center justify-center text-gray-400">
            <canvas id="grafikLaporan"></canvas>
         </div>

         <div class="flex justify-center mt-4">
            <form method="GET" action="{{ route('jr.statistik-laporan.unduh') }}">
               <!-- Jika tahun dipilih, kirimkan tahun -->
               <input type="hidden" name="tahun" value="{{ $tahun }}">
               <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">
                     Unduh Laporan
               </button>
            </form>
         </div>

      </div>
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   const ctx = document.getElementById('grafikLaporan').getContext('2d');
   new Chart(ctx, {
      type: 'line',
      data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
               {
                  label: 'Total Laporan',
                  data: @json($dataGrafik),
                  borderColor: '#006AB2',
                  backgroundColor: 'rgba(37, 99, 235, 0.2)',
                  borderWidth: 2,
                  fill: true,
                  tension: 0.4,
                  pointRadius: 5,
                  pointBackgroundColor: '#006AB2'
               },
               {
                  label: 'Selesai Survei',
                  data: @json($dataSelesai),
                  borderColor: '#16A34A',
                  backgroundColor: 'rgba(22, 163, 74, 0.1)',
                  borderWidth: 2,
                  fill: false,
                  tension: 0.4,
                  pointRadius: 4,
                  pointBackgroundColor: '#16A34A'
               },
               {
                  label: 'Belum Survei',
                  data: @json($dataBelumSurvei),
                  borderColor: '#DC2626',
                  backgroundColor: 'rgba(220, 38, 38, 0.1)',
                  borderWidth: 2,
                  fill: false,
                  tension: 0.4,
                  pointRadius: 4,
                  pointBackgroundColor: '#DC2626'
               }
            ]
      },
      options: {
         responsive: true,
         scales: {
            y: {
               beginAtZero: true,
               ticks: {
                  callback: function(value) {
                     return Number.isInteger(value) ? value : '';
                  }
               }
            }
         }
      }
   });
</script>

@endsection