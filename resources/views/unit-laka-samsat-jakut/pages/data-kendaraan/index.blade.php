@extends('unit-laka-samsat-jakut.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7] min-h-screen">
   <div class="p-4 mt-24">

      <form action="{{ route('data-kendaraan.index') }}" method="GET">
         @csrf
         <div class="bg-white p-4 rounded-xl shadow-md">
            <p class="font-semibold text-lg text-[#373A3C]">Filter Data Kendaraan</p>
            <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">
            <div class="flex justify-between flex-wrap gap-2">
               
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
                     @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                        <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                     @endforeach
                  </select>
               </div>

               <!-- Jenis Kendaraan -->
               <div class="flex items-center gap-2">
                  <span class="text-sm text-gray-600">Jenis Kendaraan</span>
                  <select name="jenis_kendaraan" class="border border-gray-300 rounded px-3 py-1 text-sm">
                     <option value="">Semua Jenis</option>
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
            </div>
            <div class="mt-6 flex justify-center">
               <button type="submit" class="bg-blueJR hover:bg-blueJRdark text-white px-2 py-1 rounded">Terapkan Filter</button>
            </div>
         </div>
      </form>

      <form action="{{ route('data-kendaraan.index') }}" method="GET">
         @csrf
         <div class="mx-auto bg-white p-6 rounded-xl shadow-md mt-8">
         <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">Data Kendaraan</h2>

         <hr class="bg-[#E8EEF2] h-[2px] my-4">

         <!-- Search -->
         <div class="flex items-center gap-2 mb-4 text-sm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketikkan Nomor Laporan" class="w-full border text-sm rounded px-4 py-2" />
            <button class="bg-blueJR hover:bg-blueJRdark text-white px-4 py-2 rounded whitespace-nowrap">Cari Data</button>
         </div>
      </form>

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
            @foreach ($dataKendaraan as $index => $item)
            <tr class="border-t text-center">
               <td class="border px-2 py-1">{{ $loop->iteration + ($dataKendaraan->currentPage() - 1) * $dataKendaraan->perPage() }}</td>
               <td class="border px-2 py-1 whitespace-nowrap">{{ $item->laporan_polisi }}</td>
               <td class="border px-2 py-1">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d/m/Y') }}</td>
               <td class="border px-2 py-1">{{ $item->nama_korban }}</td>
               <td class="border px-2 py-1">{{ $item->nama_tersangka }}</td>
               <td class="border px-2 py-1">{{ $item->jenis_kendaraan }}</td>
               <td class="border px-2 py-1 whitespace-nowrap">{{ $item->nomor_polisi }}</td>
               <td class="border px-2 py-1">{{ \Carbon\Carbon::parse($item->masa_pkb_sw)->format('d/m/Y') }}</td>
               <td class="border px-2 py-1 whitespace-nowrap">Rp {{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
               <td class="border px-2 py-1">{{ $item->kode_penyidik }}</td>
               <td class="border px-2 py-1 flex justify-center">
                  <img 
                     src="{{ asset($item->foto_barang_bukti) }}" 
                     class="w-12 h-12 object-cover rounded cursor-pointer"
                     onclick="showPreview('{{ asset($item->foto_barang_bukti) }}')"
                  />
               </td>
               <td class="border px-2 py-1">{{ $item->keterangan }}</td>
               <td class="border px-2 py-1 text-center">
                  <form action="{{ route('data-kendaraan-status.update', $item->id) }}" method="POST">
                     @csrf
                     @method('PUT')
                     <select name="status_perkara" onchange="this.form.submit()"
                        class="text-sm font-semibold rounded px-2 py-1 
                        {{ $item->status_perkara == 'Selesai' ? 'text-green-600' : 'text-red-600' }} 
                        bg-transparent border-none focus:outline-none">
                        <option class="text-red-600" value="Belum Selesai" {{ $item->status_perkara == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
                        <option class="text-green-600" value="Selesai" {{ $item->status_perkara == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                     </select>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
      </div>


      <!-- Pagination -->
      <div class="flex flex-col justify-center items-center mt-4">
         <div class="mb-4 flex justify-center space-x-1">
            {{-- Tombol Previous --}}
            @if ($dataKendaraan->onFirstPage())
               <button class="px-3 py-1 border rounded bg-gray-200 text-gray-500 cursor-not-allowed">Kembali</button>
            @else
               <a href="{{ $dataKendaraan->previousPageUrl() }}" class="px-3 py-1 border rounded bg-gray-200 hover:bg-gray-300">Kembali</a>
            @endif

            {{-- Tombol Halaman --}}
            @for ($i = 1; $i <= $dataKendaraan->lastPage(); $i++)
               <a href="{{ $dataKendaraan->url($i) }}"
                  class="px-3 py-1 border rounded
                  {{ $dataKendaraan->currentPage() == $i ? 'bg-blueJR text-white' : 'bg-white hover:bg-gray-100' }}">
                  {{ $i }}
               </a>
            @endfor

            {{-- Tombol Next --}}
            @if ($dataKendaraan->hasMorePages())
               <a href="{{ $dataKendaraan->nextPageUrl() }}" class="px-3 py-1 border rounded bg-gray-200 hover:bg-gray-300">Selanjutnya</a>
            @else
               <button class="px-3 py-1 border rounded bg-gray-200 text-gray-500 cursor-not-allowed">Selanjutnya</button>
            @endif
         </div>


         <form action="{{ route('data-kendaraan.unduh') }}" method="GET">
            {{-- Bawa semua parameter filter dan search --}}
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="tahun" value="{{ request('tahun') }}">
            <input type="hidden" name="bulan" value="{{ request('bulan') }}">
            <input type="hidden" name="jenis_kendaraan" value="{{ request('jenis_kendaraan') }}">
            <input type="hidden" name="status_perkara" value="{{ request('status_perkara') }}">

            <button type="submit" class="bg-blueJR text-white px-6 py-2 rounded">Unduh Data</button>
         </form>

      </div>
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