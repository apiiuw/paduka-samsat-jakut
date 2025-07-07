@extends('jasa-raharja.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7] min-h-screen">
   <div class="p-4 mt-24">

      <div class="bg-white p-4 rounded-xl shadow-md">
         <p class="font-semibold text-lg text-[#373A3C]">Filter Data Laporan</p>
         <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">
         <form action="{{ route('jr.data-laporan.index') }}" method="GET" class="flex justify-between flex-wrap gap-2">
            <!-- Tahun -->
            <div class="flex items-center gap-2">
                  <span class="text-sm text-gray-600">Tahun</span>
                  <select name="tahun" class="border border-gray-300 rounded px-3 py-1 text-sm">
                     <option value="">Semua Tahun</option>
                     <option value="2025/2026" {{ request('tahun') == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                     <option value="2024/2025" {{ request('tahun') == '2024/2025' ? 'selected' : '' }}>2024/2025</option>
                  </select>
            </div>

            <!-- Bulan -->
            <div class="flex items-center gap-2">
                  <span class="text-sm text-gray-600">Bulan</span>
                  <select name="bulan" class="border border-gray-300 rounded px-3 py-1 text-sm">
                     <option value="">Semua Bulan</option>
                     <option value="Januari" {{ request('bulan') == 'Januari' ? 'selected' : '' }}>Januari</option>
                     <option value="Februari" {{ request('bulan') == 'Februari' ? 'selected' : '' }}>Februari</option>
                     <option value="Maret" {{ request('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                     <option value="April" {{ request('bulan') == 'April' ? 'selected' : '' }}>April</option>
                     <option value="Mei" {{ request('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                     <option value="Juni" {{ request('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                     <option value="Juli" {{ request('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                     <option value="Agustus" {{ request('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                     <option value="September" {{ request('bulan') == 'September' ? 'selected' : '' }}>September</option>
                     <option value="Oktober" {{ request('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                     <option value="November" {{ request('bulan') == 'November' ? 'selected' : '' }}>November</option>
                     <option value="Desember" {{ request('bulan') == 'Desember' ? 'selected' : '' }}>Desember</option>
                  </select>
            </div>

            <!-- Jenis Kendaraan -->
            <div class="flex items-center gap-2">
                  <span class="text-sm text-gray-600">Jenis Kendaraan</span>
                  <select name="jenis_kendaraan" class="border border-gray-300 rounded px-3 py-1 text-sm">
                     <option value="">Semua Jenis Kendaraan</option>
                     <option value="Roda 2" {{ request('jenis_kendaraan') == 'Roda 2' ? 'selected' : '' }}>Roda 2</option>
                     <option value="Roda 4" {{ request('jenis_kendaraan') == 'Roda 4' ? 'selected' : '' }}>Roda 4</option>
                     <option value="Diatas Roda 4" {{ request('jenis_kendaraan') == 'Diatas Roda 4' ? 'selected' : '' }}>Diatas Roda 4</option>
                  </select>
            </div>

            <!-- Status Perkara -->
            <div class="flex items-center gap-2">
                  <span class="text-sm text-gray-600">Status Perkara</span>
                  <select name="status_perkara" class="border border-gray-300 rounded px-3 py-1 text-sm">
                     <option value="">Semua Status</option>
                     <option value="Selesai" {{ request('status_perkara') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                     <option value="Belum Selesai" {{ request('status_perkara') == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
                  </select>
            </div>

            <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded whitespace-nowrap">Terapkan Filter</button>
         </form>
      </div>


      <div class="mx-auto bg-white p-6 rounded-xl shadow-md mt-8">
         <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">Data Laporan</h2>
         <hr class="bg-[#E8EEF2] h-[2px] my-4">

         <div class="flex items-center gap-2 mb-4 text-sm">
            <!-- Form Pencarian -->
            <form action="{{ route('jr.data-laporan.index') }}" method="GET" class="flex w-full">
               <!-- Input Pencarian -->
               <input type="text" name="search" placeholder="Ketikkan Laporan Polisi atau Nomor Polisi" value="{{ request('search') }}" class="flex-grow border text-sm rounded px-4 py-2 mr-2" />
               
               <!-- Tombol Cari Data -->
               <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded whitespace-nowrap">Cari Data</button>
            </form>
         </div>

         <!-- Table -->
         <div class="overflow-x-auto w-full">
            <table class="min-w-[1600px] border text-sm text-left">
               <thead class="bg-[#373D53] text-white text-center">
                     <tr>
                        <th class="border px-2 py-1">No</th>
                        <th class="border px-2 py-1">Laporan Polisi</th>
                        <th class="border px-2 py-1">Tanggal Laporan</th>
                        <th class="border px-2 py-1">Tanggal Kejadian</th>
                        <th class="border px-2 py-1">Jenis Kendaraan</th>
                        <th class="border px-2 py-1">Nomor Polisi</th>
                        <th class="border px-2 py-1">Masa Berlaku PKB/SW</th>
                        <th class="border px-2 py-1">Estimasi Tunggakan</th>
                        <th class="border px-2 py-1">Foto Barang Bukti</th>
                        <th class="border px-2 py-1">Status Validasi</th>
                        <th class="border px-2 py-1">Status Survei</th>
                        <th class="border px-2 py-1">Status Perkara</th>
                     </tr>
               </thead>
               <tbody class="bg-white">
                     @php
                        $no = 1; // Inisialisasi variabel $no
                     @endphp

                     @foreach ($dataLaporan->groupBy('laporan_polisi') as $laporanPolisi => $items)
                        @php
                           $rowspan = $items->count(); // Menghitung jumlah baris untuk laporan yang sama
                        @endphp

                        @foreach ($items as $index => $item)
                           <tr class="border-t text-center">
                                 {{-- Tampilkan No, laporan_polisi, tanggal_laporan, dan tanggal_kejadian hanya pada baris pertama --}}
                                 @if ($index == 0)
                                    <td class="border px-2 py-1" rowspan="{{ $rowspan }}">{{ $no++ }}</td> <!-- Nomor urut -->
                                    <td class="border px-2 py-1 whitespace-nowrap" rowspan="{{ $rowspan }}">{{ $item->laporan_polisi }}</td>
                                    <td class="border px-2 py-1" rowspan="{{ $rowspan }}">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d/m/Y') }}</td>
                                    <td class="border px-2 py-1" rowspan="{{ $rowspan }}">{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d/m/Y') }}</td>
                                 @endif

                                 {{-- Data kendaraan ditampilkan di setiap baris --}}
                                 <td class="border px-2 py-1">{{ $item->jenis_kendaraan }}</td>
                                 <td class="border px-2 py-1">{{ $item->nomor_polisi }}</td>
                                 <td class="border px-2 py-1">{{ \Carbon\Carbon::parse($item->masa_berlaku_pkb_sw)->format('d/m/Y') }}</td>
                                 <td class="border px-2 py-1 whitespace-nowrap">Rp {{ number_format($item->estimasi_tunggakan, 0, ',', '.') }}</td>
                                 <td class="border px-2 py-1 flex justify-center">
                                    <img src="{{ asset($item->foto_barang_bukti) }}" class="w-12 h-12 object-cover rounded cursor-pointer"
                                       onclick="showPreview('{{ asset($item->foto_barang_bukti) }}')" />
                                 </td>

                                 <form action="{{ route('jr.updateStatus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Using PUT for update -->
                                    <td class="border px-2 py-1">
                                       <select name="status_validasi" class="form-control" onchange="this.form.submit()">
                                             <!-- Default option (empty) to prompt the user to select if they haven't already -->
                                             <option value="" disabled {{ !$item->status_validasi ? 'selected' : '' }}>Pilih Status</option>
                                             <option value="Jakarta Pusat" {{ $item->status_validasi == 'Jakarta Pusat' ? 'selected' : '' }}>Jakarta Pusat</option>
                                             <option value="Jakarta Utara" {{ $item->status_validasi == 'Jakarta Utara' ? 'selected' : '' }}>Jakarta Utara</option>
                                             <option value="Jakarta Selatan" {{ $item->status_validasi == 'Jakarta Selatan' ? 'selected' : '' }}>Jakarta Selatan</option>
                                             <option value="Jakarta Timur" {{ $item->status_validasi == 'Jakarta Timur' ? 'selected' : '' }}>Jakarta Timur</option>
                                             <option value="Jakarta Barat" {{ $item->status_validasi == 'Jakarta Barat' ? 'selected' : '' }}>Jakarta Barat</option>
                                       </select>
                                    </td>
                                 </form>

                                 <td class="border px-2 py-1">
                                    @if($item->status_survei === 'Selesai Survei')
                                          <span class="text-green-600 font-semibold">{{ $item->status_survei }}</span>
                                    @else
                                          <span class="text-red-600 font-semibold">{{ $item->status_survei }}</span>
                                    @endif
                                 </td>

                                 {{-- Status Perkara hanya ditampilkan pada baris pertama untuk setiap grup --}}
                                 @if ($index == 0)
                                    <td class="border px-2 py-1 text-center" rowspan="{{ $rowspan }}">
                                       <!-- Menampilkan Status Perkara sebagai Teks -->
                                       <span class="font-semibold {{ $item->status_perkara == 'Selesai' ? 'text-green-600' : 'text-red-600' }}">
                                             {{ $item->status_perkara }}
                                       </span>
                                    </td>
                                 @endif
                           </tr>
                        @endforeach
                     @endforeach
               </tbody>
            </table>
         </div>


         <!-- Pagination -->
         <div class="flex flex-col justify-center items-center mt-4">
            <div class="mb-4">
               <!-- Tombol Previous -->
               @if ($dataLaporan->onFirstPage())
                     <button class="px-3 py-1 border rounded bg-gray-200 mr-1" disabled>Previous</button>
               @else
                     <a href="{{ $dataLaporan->previousPageUrl() }}">
                        <button class="px-3 py-1 border rounded bg-gray-200 mr-1">Previous</button>
                     </a>
               @endif

               <!-- Pagination Links -->
               @foreach ($dataLaporan->getUrlRange(1, $dataLaporan->lastPage()) as $page => $url)
                     <a href="{{ $url }}">
                        <button class="px-3 py-1 border rounded {{ $page == $dataLaporan->currentPage() ? 'bg-blueJR text-white' : 'bg-white' }}">
                           {{ $page }}
                        </button>
                     </a>
               @endforeach

               <!-- Tombol Next -->
               @if ($dataLaporan->hasMorePages())
                     <a href="{{ $dataLaporan->nextPageUrl() }}">
                        <button class="px-3 py-1 border rounded bg-gray-200 ml-1">Next</button>
                     </a>
               @else
                     <button class="px-3 py-1 border rounded bg-gray-200 ml-1" disabled>Next</button>
               @endif
            </div>
            <button onclick="window.location='{{ route('jr.laporan.download', request()->query()) }}'" class="bg-blueJR text-white px-6 py-2 rounded">Unduh Data</button>
         </div>
      </div>

   </div>
</div>

<!-- Image Preview Modal -->
<div id="imagePreviewModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
   <div class="relative">
      <button onclick="closePreview()" class="absolute -top-4 -right-4 text-white text-2xl font-bold">&times;</button>
      <img id="modalImage" src="" class="max-h-[80vh] max-w-[90vw] rounded shadow-lg border-4 border-white">
   </div>
</div>

<script>
function showPreview(src) {
   const modal = document.getElementById('imagePreviewModal');
   const img = document.getElementById('modalImage');
   img.src = src;
   modal.classList.remove('hidden');
}

function closePreview() {
   document.getElementById('imagePreviewModal').classList.add('hidden');
}
</script>

@endsection