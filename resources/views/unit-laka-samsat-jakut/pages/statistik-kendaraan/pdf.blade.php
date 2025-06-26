<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kendaraan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .statistik { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 5px; text-align: left; }
        img.chart { width: 100%; height: auto; margin-top: 20px; }
    </style>
</head>
<body>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .statistik {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #999;
            padding: 3px 4px;
            text-align: center;
            vertical-align: middle;
        }

        td:not(.keterangan):not(.no),
        th:not(.keterangan):not(.no) {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 70px;
        }

        td.no,
        th.no {
            width: 25px;
            max-width: 25px;
        }

        td.keterangan {
            text-align: left;
            white-space: normal;
        }

        img.chart {
            width: 100%;
            height: auto;
            margin-top: 20px;
        }

        td img {
            object-fit: cover;
            border-radius: 4px;
        }
    </style>

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
        <colgroup>
            <col style="width: 25px;"> <!-- No -->
            <col style="width: 85px;"> <!-- Laporan Polisi -->
            <col style="width: 65px;"> <!-- Tanggal Laporan -->
            <col style="width: 65px;"> <!-- Tanggal Kejadian -->
            <col style="width: 55px;"> <!-- Kode Penyidik -->
            <col style="width: 75px;"> <!-- Nama Korban -->
            <col style="width: 75px;"> <!-- Nama Tersangka -->
            <col style="width: 75px;"> <!-- Jenis Kendaraan -->
            <col style="width: 75px;"> <!-- Nomor Polisi -->
            <col style="width: 85px;"> <!-- Masa Berlaku -->
            <col style="width: 85px;"> <!-- Total Kerugian -->
            <col style="width: 60px;"> <!-- Foto Barang Bukti -->
            <col style="width: 120px;"> <!-- Keterangan -->
            <col style="width: 70px;"> <!-- Status -->
        </colgroup>

        <thead>
            <tr>
                <th class="no">No</th>
                <th>Laporan Polisi</th>
                <th>Tanggal Laporan</th>
                <th>Tanggal Kejadian</th>
                <th>Kode Penyidik</th>
                <th>Nama Korban</th>
                <th>Nama Tersangka</th>
                <th>Jenis Kendaraan</th>
                <th>Nomor Polisi</th>
                <th>Masa Berlaku PKB & SW</th>
                <th>Total Kerugian</th>
                <th>Foto Barang Bukti</th>
                <th>Keterangan</th>
                <th>Status Perkara</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $i => $group)
            @php
                $first = $group->first();
                $rowspan = $group->count();
            @endphp

            @foreach($group as $j => $item)
                <tr>
                    {{-- Kolom yang hanya ditampilkan sekali --}}
                    @if($j == 0)
                        <td class="no" rowspan="{{ $rowspan }}">{{ $i + 1 }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $first->laporan_polisi }}</td>
                        <td rowspan="{{ $rowspan }}">
                            {{ $first->tanggal_laporan ? \Carbon\Carbon::parse($first->tanggal_laporan)->format('d/m/Y') : '-' }}
                        </td>
                        <td rowspan="{{ $rowspan }}">
                            {{ $first->tanggal_kejadian ? \Carbon\Carbon::parse($first->tanggal_kejadian)->format('d/m/Y') : '-' }}
                        </td>
                        <td rowspan="{{ $rowspan }}">{{ $first->kode_penyidik }}</td>
                    @endif

                    {{-- Kolom per kendaraan --}}
                    <td>{{ $item->nama_korban }}</td>
                    <td>{{ $item->nama_tersangka }}</td>
                    <td>{{ $item->jenis_kendaraan }}</td>
                    <td>{{ $item->nomor_polisi }}</td>
                    <td>{{ $item->masa_berlaku_pkb_sw }}</td>
                    <td>Rp {{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
                    <td>
                        @if($item->foto_barang_bukti && file_exists(public_path($item->foto_barang_bukti)))
                            <img src="{{ public_path($item->foto_barang_bukti) }}" alt="Foto" width="30" height="30">
                        @else
                            -
                        @endif
                    </td>
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
