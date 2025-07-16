<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kendaraan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .statistik {
            margin-bottom: 20px;
        }

        img.chart {
            width: 100%;
            height: auto;
            margin-top: 20px;
        }

        @page {
            size: A4 landscape;
            margin: 5mm;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            page-break-inside: auto;
        }

        th, td {
            border: 1px solid #000;
            padding: 3px 4px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        td img {
            max-width: 50px;
            height: auto;
        }

        td {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid; /* Jangan bagi satu grup di halaman yang berbeda */
        }

        .new-page {
            page-break-before: always; /* Pindahkan grup besar ke halaman baru */
        }

    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Statistik Kendaraan Tahun {{ $tahun }}</h2>
    </div>

    <div class="statistik">
        <p><strong>Total Data Kendaraan:</strong> {{ $totalData }}</p>
        <p><strong>Total Perkara Selesai:</strong> {{ $totalSelesai }}</p>
        <p><strong>Total Perkara Belum Selesai:</strong> {{ $totalBelumSelesai }}</p>
    </div>

    <p style="text-align: left; font-weight: bold; margin-bottom: 10px;">
        Grafik Data Kendaraan per Bulan - Tahun {{ $tahun }}:
    </p>

    <div style="text-align: center; margin: 20px 0;">
        <img src="data:image/png;base64,{{ $grafikBase64 }}" alt="Grafik"
            style="width: 500px; height: 250px;">
    </div>

    <p><strong>Rincian Data:</strong></p>
    <table>
        <thead>
            <tr>
                <th class="no">No</th>
                <th>Laporan Polisi</th>
                <th>Tanggal Laporan</th>
                <th>Tanggal Kejadian</th>
                <th>Kode Penyidik</th>
                <th>Nama Tersangka</th>
                <th>Jenis Kendaraan Tersangka</th>
                <th>Nomor Polisi Tersangka</th>
                <th>Masa Berlaku SW Tersangka</th>
                <th>Foto Barang Bukti Tersangka</th>
                <th>Status Kendaraan Tersangka</th>
                <th>Nama Korban</th>
                <th>Jenis Kendaraan Korban</th>
                <th>Nomor Polisi Korban</th>
                <th>Masa Berlaku SW Korban</th>
                <th>Total Kerugian Korban</th>
                <th>Foto Barang Bukti Korban</th>
                <th>Status Kendaraan Korban</th>
                <th>Keterangan</th>
                <th>Status Perkara</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $i => $group)
                @php
                    $first = $group->first();
                    $rowspan = $group->count();
                @endphp

                @foreach($group as $j => $item)
                    {{-- Jika data sudah lebih dari 4 dan tidak muat, pindah ke halaman baru --}}
                    @if($j == 0 && $rowspan > 2)
                        <tr class="new-page">
                    @else
                        <tr>
                    @endif
                        {{-- Kolom yang hanya ditampilkan sekali --}}
                        @if($j == 0)
                            <td class="no" rowspan="{{ $rowspan }}">{{ $no++ }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $first->laporan_polisi }}</td>
                            <td rowspan="{{ $rowspan }}">{{
                                $first->tanggal_laporan ? \Carbon\Carbon::parse($first->tanggal_laporan)->format('d/m/Y') : '-'
                            }}</td>
                            <td rowspan="{{ $rowspan }}">{{
                                $first->tanggal_kejadian ? \Carbon\Carbon::parse($first->tanggal_kejadian)->format('d/m/Y') : '-'
                            }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $first->kode_penyidik }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $first->nama_tersangka ?? '-' }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $first->jenis_kendaraan_tersangka ?? '-' }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $first->nomor_polisi_tersangka ?? '-' }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $first->masa_berlaku_pkb_sw_tersangka ?? '-' }}</td>
                            <td rowspan="{{ $rowspan }}">
                                @if($item->foto_barang_bukti_tersangka && file_exists(public_path($item->foto_barang_bukti_tersangka)))
                                    <img src="{{ public_path($item->foto_barang_bukti) }}" alt="Foto">
                                @else
                                    -
                                @endif
                            </td>
                            <td rowspan="{{ $rowspan }}">{{ $first->status_kendaraan_tersangka ?? '-' }}</td>
                        @endif

                        {{-- Kolom per kendaraan --}}
                        <td>{{ $item->nama_korban }}</td>
                        <td>{{ $item->jenis_kendaraan }}</td>
                        <td>{{ $item->nomor_polisi }}</td>
                        <td>{{ $item->masa_berlaku_pkb_sw }}</td>
                        <td>Rp {{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
                        <td>
                            @if($item->foto_barang_bukti && file_exists(public_path($item->foto_barang_bukti)))
                                <img src="{{ public_path($item->foto_barang_bukti) }}" alt="Foto">
                            @else
                                -
                            @endif
                        </td>
                        <td class="keterangan">{{ $item->status_kendaraan_korban ?? '-' }}</td>
                        <td class="keterangan">{{ $item->keterangan ?? '-' }}</td>

                        @if($j == 0)
                            <td rowspan="{{ $rowspan }}">{{ $first->status_perkara }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
