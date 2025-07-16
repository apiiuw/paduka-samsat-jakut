<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kendaraan</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 5mm; /* Margin lebih kecil untuk memaksimalkan ruang */
        }

        body {
            font-family: sans-serif;
            font-size: 9px; /* Ukuran font sedikit lebih besar */
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .container {
            width: 100%;
            overflow-x: auto;  /* Memungkinkan scroll jika konten terlalu lebar */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed; /* Mengatur lebar kolom tetap berdasarkan ukuran */
        }

        th, td {
            border: 1px solid #000;
            padding: 5px 8px; /* Padding sedikit lebih besar */
            text-align: center;
            font-size: 8px; /* Ukuran font sedikit lebih besar */
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            word-wrap: break-word;  /* Menjaga teks tidak terpotong di thead */
            white-space: normal;
        }

        /* Menyesuaikan lebar kolom agar tidak terpotong */
        th:nth-child(1), td:nth-child(1) { width: 5%; }
        th:nth-child(2), td:nth-child(2) { width: 10%; }
        th:nth-child(3), td:nth-child(3) { width: 9%; }
        th:nth-child(4), td:nth-child(4) { width: 9%; }
        th:nth-child(5), td:nth-child(5) { width: 9%; }
        th:nth-child(6), td:nth-child(6) { width: 10%; }
        th:nth-child(7), td:nth-child(7) { width: 10%; }
        th:nth-child(8), td:nth-child(8) { width: 10%; }
        th:nth-child(9), td:nth-child(9) { width: 8%; }
        th:nth-child(10), td:nth-child(10) { width: 10%; }
        th:nth-child(11), td:nth-child(11) { width: 10%; }
        th:nth-child(12), td:nth-child(12) { width: 10%; }
        th:nth-child(13), td:nth-child(13) { width: 10%; }
        th:nth-child(14), td:nth-child(14) { width: 10%; }
        th:nth-child(15), td:nth-child(15) { width: 10%; }
        th:nth-child(16), td:nth-child(16) { width: 10%; }
        th:nth-child(17), td:nth-child(17) { width: 8%; }

        td img {
            max-width: 40px; /* Ukuran gambar lebih besar tetapi tetap proporsional */
            height: auto;
        }

        td {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .text-center {
            text-align: center;
        }

    </style>
</head>
<body>
    <h2>Laporan Data Kendaraan</h2>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Laporan Polisi</th>
                    <th>Tanggal Laporan</th>
                    <th>Tanggal Kejadian</th>
                    <th>Jenis Kendaraan Tersangka</th>
                    <th>Nomor Polisi Tersangka</th>
                    <th>Masa Berlaku SW Tersangka</th>
                    <th>Estimasi Tunggakan SW Tersangka</th>
                    <th>Foto Barang Bukti Tersangka</th>
                    <th>Status Validasi Tersangka</th>
                    <th>Jenis Kendaraan Korban</th>
                    <th>Nomor Polisi Korban</th>
                    <th>Masa Berlaku SW Korban</th>
                    <th>Estimasi Tunggakan SW Korban</th>
                    <th>Foto Barang Bukti Korban</th>
                    <th>Status Validasi Korban</th>
                    <th>Status Perkara</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp

                @foreach ($dataLaporan->groupBy('laporan_polisi') as $laporanPolisi => $items)
                    @php
                        $rowspan = $items->count();
                    @endphp

                    @foreach ($items as $index => $item)
                        <tr class="border-t text-center">
                            {{-- Tampilkan No, laporan_polisi, tanggal_laporan, dan tanggal_kejadian hanya pada baris pertama --}}
                            @if ($index == 0)
                                <td rowspan="{{ $rowspan }}">{{ $no++ }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $item->laporan_polisi }}</td>
                                <td rowspan="{{ $rowspan }}">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d/m/Y') }}</td>
                                <td rowspan="{{ $rowspan }}">{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d/m/Y') }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $item->jenis_kendaraan_tersangka }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $item->nomor_polisi_tersangka }}</td>
                                <td rowspan="{{ $rowspan }}">{{ \Carbon\Carbon::parse($item->masa_berlaku_pkb_sw_tersangka)->format('d/m/Y') }}</td>
                                <td rowspan="{{ $rowspan }}">Rp {{ number_format($item->estimasi_tunggakan_tersangka, 0, ',', '.') }}</td>
                                <td rowspan="{{ $rowspan }}">

                                    <img src="{{ public_path($item->foto_barang_bukti_tersangka) }}" class="w-12 h-12 object-cover rounded cursor-pointer" />
                                </td>
                                <td rowspan="{{ $rowspan }}">{{ $item->status_validasi_tersangka }}</td>
                            @endif

                            {{-- Data kendaraan ditampilkan di setiap baris --}}
                            <td>{{ $item->jenis_kendaraan ?? '-' }}</td>
                            <td>{{ $item->nomor_polisi ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->masa_berlaku_pkb_sw)->format('d/m/Y') ?? '-' }}</td>
                            <td>Rp {{ number_format($item->estimasi_tunggakan, 0, ',', '.') ?? '-' }}</td>
                            <td>
                                <img src="{{ public_path($item->foto_barang_bukti) }}" class="w-12 h-12 object-cover rounded cursor-pointer" />
                            </td>
                            <td>{{ $item->status_validasi ?? '-' }}</td>

                            {{-- Status Perkara hanya ditampilkan pada baris pertama untuk setiap grup --}}
                            @if ($index == 0)
                                <td rowspan="{{ $rowspan }}">
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
</body>
</html>
