@extends('surveyor.layouts.main')
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
            <form action="{{ route('surveyor.data-survei.index') }}" method="GET" class="flex w-full">
               <!-- Input Pencarian -->
               <input type="text" name="search" placeholder="Ketikkan Laporan Polisi atau Nomor Polisi" value="{{ request('search') }}" class="flex-grow border text-sm rounded px-4 py-2 mr-2" />
               
               <!-- Tombol Cari Data -->
               <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded whitespace-nowrap">Cari Data</button>
            </form>
         </div>

         <!-- Table -->
         <div class="overflow-x-auto w-full">
            <table class="min-w-[2500px] border text-sm text-left">
               <thead class="bg-[#373D53] text-white text-center">
                     <tr>
                        <th class="border px-2 py-1">No</th>
                        <th class="border px-2 py-1">Laporan Polisi</th>
                        <th class="border px-2 py-1">Tanggal Laporan</th>
                        <th class="border px-2 py-1">Tanggal Kejadian</th>
                        <th class="border px-2 py-1">Jenis Kendaraan Tersangka</th>
                        <th class="border px-2 py-1">Nomor Polisi Tersangka</th>
                        <th class="border px-2 py-1">Masa Berlaku SW Tersangka</th>
                        <th class="border px-2 py-1">Estimasi Tunggakan Tersangka</th>
                        <th class="border px-2 py-1">Foto Barang Bukti Tersangka</th>
                        <th class="border px-2 py-1">Status Survei Tersangka</th>
                        <th class="border px-2 py-1">Input Hasil Survei Tersangka</th>
                        <th class="border px-2 py-1">Jenis Kendaraan Korban</th>
                        <th class="border px-2 py-1">Nomor Polisi Korban</th>
                        <th class="border px-2 py-1">Masa Berlaku SW Korban</th>
                        <th class="border px-2 py-1">Estimasi Tunggakan Korban</th>
                        <th class="border px-2 py-1">Foto Barang Bukti Korban</th>
                        <th class="border px-2 py-1">Status Survei Korban</th>
                        <th class="border px-2 py-1">Input Hasil Survei Korban</th>
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
                                <td class="border px-2 py-1 whitespace-nowrap" rowspan="{{ $rowspan }}">{{ $item->jenis_kendaraan_tersangka }}</td>
                                <td class="border px-2 py-1 whitespace-nowrap" rowspan="{{ $rowspan }}">{{ $item->nomor_polisi_tersangka }}</td>
                                <td class="border px-2 py-1 whitespace-nowrap" rowspan="{{ $rowspan }}">{{ $item->masa_berlaku_pkb_sw_tersangka }}</td>
                                <td class="border px-2 py-1 whitespace-nowrap" rowspan="{{ $rowspan }}">Rp {{ number_format($item->estimasi_tunggakan_tersangka, 0, ',', '.') }}</td>
                                <td class="border" rowspan="{{ $rowspan }}">
                                    <div class="flex justify-center px-2 py-1">
                                        <img src="{{ asset($item->foto_barang_bukti_tersangka) }}" class="w-12 h-12 object-cover rounded cursor-pointer"
                                        onclick="showPreview('{{ asset($item->foto_barang_bukti_tersangka) }}')" />
                                    </div>
                                </td>
                                <td class="border px-2 py-1 whitespace-nowrap" rowspan="{{ $rowspan }}">
                                    @if($item->status_survei_tersangka === 'Selesai Survei')
                                        <span class="text-green-600 font-semibold">{{ $item->status_survei_tersangka }}</span>
                                        @else
                                        <span class="text-red-600 font-semibold">{{ $item->status_survei_tersangka }}</span>
                                    @endif
                                </td>
                                <td class="border px-2 py-1 whitespace-nowrap" rowspan="{{ $rowspan }}">
                                    @if ($item->catatan_hasil_survei_tersangka)
                                        <button class="bg-green-500 text-white px-4 py-2 rounded cursor-not-allowed" disabled>Sudah Survei</button>
                                    @else
                                        <a href="{{ route('surveyor.data-survei.input.tersangka', ['id' => $item->id]) }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                            Input
                                        </a>
                                    @endif
                                </td>
                            @endif

                            {{-- Data kendaraan ditampilkan di setiap baris --}}
                            <td class="border px-2 py-1 whitespace-nowrap">{{ $item->jenis_kendaraan }}</td>
                            <td class="border px-2 py-1 whitespace-nowrap">{{ $item->nomor_polisi }}</td>
                            <td class="border px-2 py-1 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->masa_berlaku_pkb_sw)->format('d/m/Y') }}</td>
                            <td class="border px-2 py-1 whitespace-nowrap">Rp {{ number_format($item->estimasi_tunggakan, 0, ',', '.') }}</td>
                            <td class="border px-2 py-1 flex justify-center">
                                <img src="{{ asset($item->foto_barang_bukti) }}" class="w-12 h-12 object-cover rounded cursor-pointer"
                                    onclick="showPreview('{{ asset($item->foto_barang_bukti) }}')" />
                            </td>
                            <td class="border px-2 py-1 whitespace-nowrap">
                                @if($item->status_survei === 'Selesai Survei')
                                    <span class="text-green-600 font-semibold">{{ $item->status_survei }}</span>
                                @else
                                    <span class="text-red-600 font-semibold">{{ $item->status_survei }}</span>
                                @endif
                            </td>

                            {{-- Tombol untuk menambahkan catatan hasil survei --}}
                            <td class="border px-2 py-1">
                                @if ($item->catatan_hasil_survei)
                                    <button class="bg-green-500 text-white px-4 py-2 rounded cursor-not-allowed" disabled>Sudah Survei</button>
                                @else
                                    <a href="{{ route('surveyor.data-survei.input.tersangka', ['id' => $item->id]) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                        Input
                                    </a>
                                @endif
                            </td>

                            {{-- Status Perkara hanya ditampilkan pada baris pertama untuk setiap grup --}}
                            @if ($index == 0)
                                <td class="border px-2 py-1 text-center" rowspan="{{ $rowspan }}">
                                    <span class="font-semibold {{ $item->status_perkara == 'Selesai' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->status_perkara }}
                                    </span>
                                </td>
                            @endif
                        </tr>

                        {{-- Modal untuk menambahkan catatan --}}
                        <div id="catatanModal{{ $item->id }}" class="modal fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden">
                            <div class="bg-white p-6 rounded-lg w-96">
                                <div class="mb-4 flex justify-between items-center">
                                    <h5 class="text-xl font-bold">Tambahkan Catatan</h5>
                                    <button class="text-gray-500" onclick="closeModal('catatanModal{{ $item->id }}')">X</button>
                                </div>
                                
                                <div id="modalContent{{ $item->id }}" class="mb-4">
                                    <p><strong>Laporan Polisi:</strong> <span id="laporanPolisi{{ $item->id }}"></span></p>
                                    <p><strong>Jenis Kendaraan:</strong> <span id="jenisKendaraan{{ $item->id }}"></span></p>
                                    <p><strong>Nomor Polisi:</strong> <span id="nomorPolisi{{ $item->id }}"></span></p>
                                    <p><strong>Masa Berlaku PKB/SW:</strong> <span id="masaBerlakuPKBSW{{ $item->id }}"></span></p>
                                    <p><strong>Estimasi Tunggakan:</strong> <span id="estimasiTunggakan{{ $item->id }}"></span></p>
                                </div>

                                <form action="{{ route('surveyor.updateCatatan', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="catatan_hasil_survei" class="form-label">Catatan Hasil Survei</label>
                                        <textarea class="form-control w-full p-2 border rounded" name="catatan_hasil_survei" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Catatan</button>
                                </form>
                            </div>
                        </div>
                        @endforeach


                        <script>
                            // Fungsi untuk membuka modal dan mengisi data berdasarkan ID unik
                            function openModal(itemId, laporanPolisi, jenisKendaraan, nomorPolisi, masaBerlakuPKBSW, estimasiTunggakan) {
                                // Menampilkan modal dengan mengubah class 'hidden' menjadi 'flex'
                                document.getElementById('catatanModal' + itemId).classList.remove('hidden');

                                // Mengisi data ke dalam modal sesuai item yang diklik
                                document.getElementById('laporanPolisi' + itemId).innerText = laporanPolisi;
                                document.getElementById('jenisKendaraan' + itemId).innerText = jenisKendaraan;
                                document.getElementById('nomorPolisi' + itemId).innerText = nomorPolisi;
                                document.getElementById('masaBerlakuPKBSW' + itemId).innerText = masaBerlakuPKBSW;
                                document.getElementById('estimasiTunggakan' + itemId).innerText = 'Rp ' + estimasiTunggakan;
                            }

                            // Fungsi untuk menutup modal
                            function closeModal(modalId) {
                                // Menyembunyikan modal dengan menambahkan class 'hidden'
                                document.getElementById(modalId).classList.add('hidden');
                            }
                        </script>

                     @endforeach
               </tbody>
            </table>
         </div>


         <!-- Pagination -->
         <div class="flex flex-col justify-center items-center mt-4">
            <div class="mb-4">
               @if ($dataLaporan->onFirstPage())
                     <button class="px-3 py-1 border rounded bg-gray-200 mr-1" disabled>Previous</button>
               @else
                     <a href="{{ $dataLaporan->previousPageUrl() }}">
                        <button class="px-3 py-1 border rounded bg-gray-200 mr-1">Previous</button>
                     </a>
               @endif

               @foreach ($dataLaporan->getUrlRange(1, $dataLaporan->lastPage()) as $page => $url)
                     <a href="{{ $url }}">
                        <button class="px-3 py-1 border rounded {{ $page == $dataLaporan->currentPage() ? 'bg-blueJR text-white' : 'bg-white' }}">
                           {{ $page }}
                        </button>
                     </a>
               @endforeach

               @if ($dataLaporan->hasMorePages())
                     <a href="{{ $dataLaporan->nextPageUrl() }}">
                        <button class="px-3 py-1 border rounded bg-gray-200 ml-1">Next</button>
                     </a>
               @else
                     <button class="px-3 py-1 border rounded bg-gray-200 ml-1" disabled>Next</button>
               @endif
            </div>
            <button onclick="window.location='{{ route('surveyor.data-survei.download', request()->query()) }}'" class="bg-blueJR text-white px-6 py-2 rounded">Unduh Data</button>
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


@endsection