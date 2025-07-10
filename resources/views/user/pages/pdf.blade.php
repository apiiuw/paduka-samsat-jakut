<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghapusan Kendaraan</title>
    <style>
        body {
            font-family: 'Calibri', sans-serif;
            font-size: 12pt;
            margin: 0px;
            padding: 0;
        }

        .content {
            margin-left: 10px;
            margin-right: 10px;
        }

        .date {
            text-align: right;
            font-size: 12pt;
            margin-bottom: 10px;
        }

        .title {
            text-align: left;
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section {
            text-align: justify;
            font-size: 12pt;
        }

        table {
            width: 100%;
            margin-left: 10px;
            border-collapse: collapse;
        }

        table td {
            padding: 2px 10px;
        }

        .label {
            width: 40%;
        }

        .titik-dua {
            width: 5px;
        }

        .value {
            text-align: left;
        }

        .footer {
            text-align: justify;
            margin-top: 5px;
        }

        .address {
            margin-left: 32px;
        }

        .signature {
            margin-top: 0px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="content">

        <div class="date">
            Jakarta, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}
        </div>

        <div class="header" style="margin-bottom: 10px;">
            Hal: Permohonan Penghapusan Data Kendaraan Bermotor</span>
        </div>

        <!-- Kepada -->
        <div class="header">
            <label>Kepada,</label><br>
        </div>

        <div>
            <p>Yth. Dirlantas Polda Metro Jaya<br><span class="address">Jl. Jend. Sudirman, Kel. Senayan, Kec. Kebayoran Baru</span><br><span class="address">Kota Jakarta Selatan, DKI Jakarta</span></p>
        </div>

        <div class="header">
            <label>Di tempat</label>
        </div>

        <div class="section" style="text-indent: 30px;">
            <p>Berdasarkan peraturan perundang-undangan yang berlaku, maka dengan ini saya bermaksud mengajukan penghapusan registrasi dan identifikasi kendaraan bermotor dengan identitas, sebagai berikut:</p>
        </div>

        <!-- Data Pemilik dan Kendaraan dalam Tabel -->
        <table style="margin-top: 20px;">
            <tr>
                <td class="label">a. Nama Pemilik</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->nama_pemilik }}</td>
            </tr>
            <tr>
                <td class="label">b. Alamat Sesuai Identitas</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->alamat_sesuai_identitas }}</td>
            </tr>
            <tr>
                <td class="label">c. NIK/TDP/NIB/Kitas/Kitab</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->nik_tdp_nib_kitas_kitab }}</td>
            </tr>
            <tr>
                <td class="label">d. No. Tlp/HP</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->no_telp }}</td>
            </tr>
            <tr>
                <td class="label">e. Email</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->email }}</td>
            </tr>
        </table>

        <div style="margin-top: 10px; margin-bottom: 10px; font-size: 12pt;">
            <label>Identitas kendaraan bermotor, sebagai berikut:</label>
        </div>

        <table style="margin-top: 20px;">
            <tr>
                <td class="label">a. NRKB</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->nrkb_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">b. Merek</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->merek_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">c. Tipe</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->tipe_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">d. Jenis</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->jenis_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">e. Model</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->model_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">f. Tahun Pembuatan</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->tahun_pembuatan_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">g. Isi Silinder / Daya Listrik</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->isi_silinder_daya_listrik_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">h. Nomor Rangka</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->nomor_rangka_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">i. Nomor Mesin</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->nomor_mesin_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">j. Warna Kendaraan Bermotor</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->warna_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">k. Bahan Bakar / Sumber Energi</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->bahan_bakar_sumber_energi_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">l. Warna TNKB</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->warna_tnkb_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">m. Nomor BPKB</td>
                <td class="titik-dua">:</td>
                <td class="value">{{ $data->nomor_bpkb_kendaraan }}</td>
            </tr>
        </table>

        <div class="section" style="margin-top: 15px;">
            <label>Alasan permohonan <strong>Penghapusan Regident Ranmor</strong> karena <strong>{{ $data->alasan_permohonan }}</strong>.</label>
        </div>

        <div class="footer">
            <p>Demikian surat permohonan ini kami buat untuk kiranya dapat diterima sesuai dengan aturan yang berlaku.</p>
        </div>
        <div class="signature">
            <p>PEMILIK</p>
            <br><br>
            <p>{{ $data->nama_pemilik }}</p>
        </div>
    </div>
</body>
</html>
