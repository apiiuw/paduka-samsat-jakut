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

        td:not(.keterangan),
        th:not(.keterangan) {
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
            <col class="no" style="width: 20px;">
            <col style="width: 70px;"> <!-- Laporan Polisi -->
            <col style="width: 65px;"> <!-- Tanggal -->
            <col style="width: 80px;"> <!-- Korban -->
            <col style="width: 80px;"> <!-- Tersangka -->
            <col style="width: 70px;"> <!-- Jenis Kendaraan -->
            <col style="width: 80px;"> <!-- Nomor Polisi -->
            <col style="width: 85px;"> <!-- Masa Berlaku -->
            <col style="width: 85px;"> <!-- Kerugian -->
            <col style="width: 55px;"> <!-- Kode Penyidik -->
            <col> <!-- Keterangan (biarkan fleksibel) -->
            <col style="width: 70px;"> <!-- Status -->
        </colgroup>

        <thead>
            <tr>
                <th class="no">No</th>
                <th>Laporan Polisi</th>
                <th>Tanggal Laporan</th>
                <th>Nama Korban</th>
                <th>Nama Tersangka</th>
                <th>Jenis Kendaraan</th>
                <th>Nomor Polisi</th>
                <th>Masa Berlaku PKB & SW</th>
                <th>Total Kerugian</th>
                <th>Kode Penyidik</th>
                <th>Foto Barang Bukti</th>
                <th>Keterangan</th>
                <th>Status Perkara</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr>
                <td class="no">{{ $i + 1 }}</td>
                <td>{{ $item->laporan_polisi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_laporan)->translatedFormat('d F Y') }}</td>
                <td>{{ $item->nama_korban }}</td>
                <td>{{ $item->nama_tersangka }}</td>
                <td>{{ $item->jenis_kendaraan }}</td>
                <td>{{ $item->nomor_polisi }}</td>
                <td>{{ $item->masa_berlaku_pkb_sw }}</td>
                <td>Rp {{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
                <td>{{ $item->kode_penyidik }}</td>
                <td>
                    @if($item->foto_barang_bukti && file_exists(public_path($item->foto_barang_bukti)))
                        <img src="{{ public_path($item->foto_barang_bukti) }}" alt="Foto" width="50" height="50">
                    @else
                        -
                    @endif
                </td>
                <td class="keterangan">{{ $item->keterangan ?? '-' }}</td>
                <td>{{ $item->status_perkara }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
