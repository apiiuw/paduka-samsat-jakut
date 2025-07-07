<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kendaraan Wajib Survei</title>
    <style>
        /* Mengatur orientasi halaman ke landscape */
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            font-size: 10px;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        /* Atur gambar agar tidak mempengaruhi layout */
        img {
            max-width: 80px;
            height: auto;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Kendaraan Wajib Survei</h2>

    <table>
        <thead>
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
                <th class="border px-2 py-1">Status Perkara</th>
            </tr>
        </thead>
        <tbody>
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
                            <img src="{{ public_path($item->foto_barang_bukti) }}" class="w-12 h-12 object-cover rounded cursor-pointer" />
                        </td>
                        <td class="border px-2 py-1">{{ $item->status_validasi }}</td> <!-- Status validasi ditampilkan di setiap baris -->

                        {{-- Status Perkara hanya ditampilkan pada baris pertama untuk setiap grup --}}
                        @if ($index == 0)
                            <td class="border px-2 py-1 text-center" rowspan="{{ $rowspan }}">
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
</body>
</html>
