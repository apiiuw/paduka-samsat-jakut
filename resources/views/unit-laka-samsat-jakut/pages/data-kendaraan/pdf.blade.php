<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kendaraan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
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
        }

        th {
            background-color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Kendaraan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Laporan Polisi</th>
                <th>Tanggal Laporan</th>
                <th>Nama Korban</th>
                <th>Nama Tersangka</th>
                <th>Jenis Kendaraan</th>
                <th>Nomor Polisi</th>
                <th>Masa Berlaku PKB/SW</th>
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
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $item->laporan_polisi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d/m/Y') }}</td>
                <td>{{ $item->nama_korban }}</td>
                <td>{{ $item->nama_tersangka ?? '-' }}</td>
                <td>{{ $item->jenis_kendaraan }}</td>
                <td>{{ $item->nomor_polisi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->masa_berlaku_pkb_sw)->format('d/m/Y') }}</td>
                <td>Rp{{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
                <td>{{ $item->kode_penyidik }}</td>
                <td>
                    @if($item->foto_barang_bukti)
                        <img src="{{ public_path($item->foto_barang_bukti) }}"
                            alt="Foto"
                            style="max-width: 80px; height: auto;">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>{{ $item->status_perkara }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>
</html>
