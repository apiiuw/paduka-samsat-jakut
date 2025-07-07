<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Survei</title>
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
        <h2>Laporan Statistik Laporan Survei Tahun {{ $tahun }}</h2>
    </div>

    <div class="statistik">
        <p><strong>Total Data Kendaraan:</strong> {{ $totalLaporan }}</p>
        <p><strong>Total Perkara Selesai:</strong> {{ $totalSelesai }}</p>
        <p><strong>Total Perkara Belum Selesai:</strong> {{ $totalBelumSurvei }}</p>
    </div>

    <p style="text-align: left; font-weight: bold; margin-bottom: 10px;">
        Grafik Data Kendaraan per Bulan - Tahun {{ $tahun }}:
    </p>

    <div style="text-align: center; margin: 20px 0;">
        <img src="data:image/png;base64,{{ $grafikBase64 }}" alt="Grafik"
            style="width: 500px; height: 250px;">
    </div>



</body>
</html>
