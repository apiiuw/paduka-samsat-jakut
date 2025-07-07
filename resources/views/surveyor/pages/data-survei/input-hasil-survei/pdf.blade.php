<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Survei #{{ $data->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; line-height: 1.6; }
        .header { text-align: right; margin-bottom: 20px; }
        .section { margin-top: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td, th { border: 1px solid #ccc; padding: 8px; vertical-align: top; }
        .img-thumb { width: 100px; height: auto; margin-top: 5px; border: 1px solid #999; }
        .ttd { margin-top: 40px; width: 100%; display: flex; justify-content: space-between; }
        .ttd-col { width: 45%; text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <p>Lampiran: 1</p>
    <p>Hal: Laporan Hasil Survei</p>

    <div class="section">
        <p>Saya yang bertanda tangan di bawah ini:</p>
        <table>
            <tr><td><strong>Nama Lengkap</strong></td><td>{{ $data->nama_surveyor }}</td></tr>
            <tr><td><strong>Petugas</strong></td><td>{{ auth()->user()->name }}</td></tr>
            <tr><td><strong>Loket</strong></td><td>{{ $data->loket_surveyor }}</td></tr>
        </table>
    </div>

    <div class="section">
        <p>
            Selaku penanggung jawab data hasil survei pemilik kendaraan, dengan ini menyatakan bahwa nama terlampir adalah
            <strong>
                @if($data->pertanyaan_1 == 'Iya') benar pemilik kendaraan
                @else bukan pemilik kendaraan
                @endif
            </strong>
            dengan nomor polisi <strong>{{ $data->nopol_kbm }}</strong> dengan jenis kendaraan <strong>{{ $data->jenis_kbm }}</strong>
            @if($data->pertanyaan_2 == 'Bersedia') <strong>bersedia melunasi PKB/SW</strong>
            @else <strong>tidak bersedia melunasi PKB/SW</strong>
            @endif

            @if($data->pertanyaan_2 == 'Tidak Bersedia' && $data->pertanyaan_3)
                dan
                @if($data->pertanyaan_3 == 'Bersedia') <strong>bersedia untuk mengajukan penghapusan data KBM</strong>.
                @else <strong>tidak bersedia untuk menghapus data KBM</strong>.
                @endif
            @else .
            @endif
        </p>
    </div>

    <div class="section">
        <p><strong>
            @if($data->pertanyaan_1 == 'Iya') Data Pemilik KBM:
            @else Data Survei:
            @endif
        </strong></p>

        <table>
            <tr>
                <td><strong>Nama Lengkap</strong></td>
                <td>{{ $data->nama_pemilik_kbm }}</td>
            </tr>
            @if($data->foto_pemilik_kbm && file_exists(public_path('storage/' . $data->foto_pemilik_kbm)))
            <tr>
                <td><strong>Foto Pemilik KBM</strong></td>
                <td>
                    <img src="{{ public_path('storage/' . $data->foto_pemilik_kbm) }}" alt="Foto Pemilik KBM" class="img-thumb">
                </td>
            </tr>
            @endif
        </table>
    </div>

    <div class="section">
        <p>
            Demikian surat ini kami sampaikan sebagai hasil survei dan dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <table style="width: 100%; margin-top: 40px; text-align: center; border: none;">
        <tr>
            <td style="width: 50%; border: none;">
                Hormat saya,<br><br><br><br>
                <strong>{{ $data->nama_surveyor }}</strong><br>
                <strong>{{ auth()->user()->name }}</strong>
            </td>
            <td style="width: 50%; border: none;">
                Menyetujui,<br><br><br><br>
                <strong>{{ $data->nama_pemilik_kbm }}</strong><br>
                <strong>
                    @if($data->pertanyaan_1 == 'Iya') Pemilik KBM
                    @else Bukan Pemilik KBM
                    @endif
                </strong>
            </td>
        </tr>
    </table>

</body>
</html>
