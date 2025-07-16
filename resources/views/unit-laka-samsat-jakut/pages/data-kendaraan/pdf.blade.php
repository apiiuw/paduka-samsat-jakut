<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kendaraan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 8px; /* Ukuran font lebih kecil */
            margin: 0;
            padding: 0;
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
            padding: 3px 5px; /* Padding lebih kecil untuk menghemat ruang */
            text-align: center; /* Mengatur teks agar rata tengah */
            word-wrap: break-word;
            white-space: normal;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        /* Menyesuaikan lebar kolom agar tidak terpotong */
        th:nth-child(1), td:nth-child(1) {
            width: 10px;
        }

        th:nth-child(2), td:nth-child(2) {
            width: 40px;
        }

        th:nth-child(3), td:nth-child(3) {
            width: 30px;
        }

        th:nth-child(4), td:nth-child(4) {
            width: 35px;
        }

        th:nth-child(5), td:nth-child(5) {
            width: 35px;
        }

        th:nth-child(6), td:nth-child(6) {
            width: 40px;
        }

        th:nth-child(7), td:nth-child(7) {
            width: 45px;
        }

        th:nth-child(8), td:nth-child(8) {
            width: 45px;
        }

        th:nth-child(9), td:nth-child(9) {
            width: 45px;
        }

        th:nth-child(10), td:nth-child(10) {
            width: 50px;
        }

        th:nth-child(11), td:nth-child(11) {
            width: 45px;
        }

        th:nth-child(12), td:nth-child(12) {
            width: 45px;
        }

        th:nth-child(13), td:nth-child(13) {
            width: 45px;
        }

        th:nth-child(14), td:nth-child(14) {
            width: 45px;
        }

        th:nth-child(15), td:nth-child(15) {
            width: 45px;
        }

        th:nth-child(16), td:nth-child(16) {
            width: 45px;
        }

        th:nth-child(17), td:nth-child(17) {
            width: 40px;
        }

        td img {
            max-width: 40px;
            height: auto;
        }

        td {
            overflow: hidden;
            text-overflow: ellipsis;
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
            @foreach($data as $i => $item)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $item->laporan_polisi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d/m/Y') }}</td>
                <td>{{ $item->kode_penyidik }}</td>
                <td>{{ $item->nama_tersangka ?? '-' }}</td>
                <td>{{ $item->jenis_kendaraan_tersangka ?? '-' }}</td>
                <td>{{ $item->nomor_polisi_tersangka ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->masa_berlaku_pkb_sw_tersangka)->format('d/m/Y') }}</td>
                <td>
                    @if($item->foto_barang_bukti_tersangka)
                        <img src="{{ public_path($item->foto_barang_bukti_tersangka) }}" alt="Foto">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $item->status_kendaraan_tersangka ?? '-' }}</td>
                <td>{{ $item->nama_korban }}</td>
                <td>{{ $item->jenis_kendaraan }}</td>
                <td>{{ $item->nomor_polisi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->masa_berlaku_pkb_sw)->format('d/m/Y') }}</td>
                <td>Rp{{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
                <td>
                    @if($item->foto_barang_bukti)
                        <img src="{{ public_path($item->foto_barang_bukti) }}" alt="Foto">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $item->status_kendaraan_korban ?? '-' }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>{{ $item->status_perkara }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
