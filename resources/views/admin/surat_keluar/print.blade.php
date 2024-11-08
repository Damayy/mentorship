<!DOCTYPE html>
<html lang="id">

<head>
    <title>PRINT SURAT KELUAR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header-img {
            width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .container-1 {
            text-align: center;
            /* Menyelaraskan elemen di dalamnya di tengah */
        }

        .center-text {
            display: inline-block;
            /* Membuat elemen hanya selebar teks */
            margin: 0 auto;
            /* Menempatkan elemen di tengah secara horizontal */
            font-weight: bold;
            /* Membuat teks menjadi tebal */
            border-bottom: 2px solid black;
            /* Menambahkan garis bawah dengan ketebalan 2px */
            padding-bottom: 5px;
            /* Memberi jarak antara teks dan garis bawah */
            text-align: center;
            /* Memastikan teks tetap berada di tengah */
            text-transform: uppercase;
            /* Mengubah teks menjadi huruf kapital */
        }

        .center-text-1 {
            text-align: center;
            margin: 0 auto;
        }

        .uppercase {
            text-transform: uppercase;
            /* Mengubah teks menjadi huruf kapital */
        }

        .left-margin {
            margin-left: 80px;
            margin-top: 25px;
        }

        .no-left-margin {
            margin-left: 20px;
            /* Tidak ada margin kiri */
            margin-top: 0;
            /* Sesuaikan margin atas jika perlu */
        }

        .table-left-margin {
            margin-left: 80px;
            /* Atur jarak untuk keseluruhan tabel jika diperlukan */
        }

        .table-left-margin td {
            padding-bottom: 5px;
            /* Atur jarak bawah */
            padding-right: 20px;
            /* Atur jarak antara teks sebelah kiri dan ':' */
        }

        .table-left-margin tr {
            margin-bottom: 0px;
            /* Hapus margin bawah antar baris jika ada */
        }

        .separator {
            padding-left: 5px;
            /* Atur jarak antara ':' dan teks sebelah kanan */
            padding-right: 5px;
            /* Tambahkan jika diperlukan */
        }

        .data {
            margin-left: -5px;
            /* Atur agar teks sebelah kanan lebih dekat dengan ':' */
        }

        .left-margin-custom {
            margin-left: 38%;
            /* Jarak dari sisi kiri halaman, sesuaikan sesuai kebutuhan */
        }

        .left-margin-special {
            margin-left: 80px;
            /* Jarak khusus dari sisi kiri */
            display: inline-block;
        }

        .justify-text {
            text-align: justify;
        }

        .span-first {
            margin-left: 80px;
            /* Jarak dari sisi kiri */
        }

        .span-second {
            margin-left: 20px;
            /* Tidak ada margin tambahan dari sisi kiri */
        }

        .span-third {
            margin-left: 20px;
            /* Tidak ada margin tambahan dari sisi kiri */
        }

        .span-four {
            margin-left: 20px;
        }

        .margin-large {
            margin-left: 80px;
            /* Margin kiri untuk kalimat pertama */
            display: inline-block;
        }

        .margin-small {
            margin-left: 20px;
            /* Margin kiri untuk kata "mestinya" */
            display: inline-block;
        }

        .align-right {
            margin-top: 40px;
            text-align: right;
            margin-right: 10%;
        }

        .data {
            margin-left: -5px;
            /* Sesuaikan dengan kebutuhan */
        }

        .text-right {
            text-align: right;
            /* Mengatur teks ke kanan */
            margin-right: 14%;
            /* Menghilangkan margin default */
            margin-bottom: 12%;
        }

        .bold-underline {
            font-weight: bold;
            /* Membuat teks menjadi tebal */
            border-bottom: 2px solid black;
            /* Garis bawah hitam */
            display: inline;
            /* Menjaga teks dan garis tetap inline */
            padding-bottom: 5px;
            /* Jarak antara teks dan garis */
        }

        .text-right-1 {
            text-align: right;
            /* Mengatur teks agar berada di sebelah kanan */
            margin-right: 12%;
            /* Menghilangkan margin default */
        }
    </style>

</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/Kopsuratt.jpg') }}" class="header-img" alt="Kop Surat">
    </div>
    <div class="container-1">
        <h3 class="center-text"><b>{{ $suratkeluar->jenis_pengajuan }}</b></h3>
        <p class="center-text-1">Nomor : {{ $suratkeluar->nomor_surat }} / S.Ket/UMUM/BW-TG / {{ $suratFormat }} / 2024
        </p>
    </div>
    <p class="left-margin">
        <b>LURAH TOBEKGODANG KECAMATAN BINAWIDYA KOTA PEKANBARU</b>, dengan
    </p>
    <p class="no-left-margin">
        ini menerangkan bahwa :
    </p>
    <table class="table-left-margin">
        <tr>
            <td>Nama</td>
            <td class="separator">:</td>
            <td class="data">{{ $suratkeluar->nama_pengaju }}</td>
        </tr>
        <tr>
            <td style="text-align: left;">Tempat / Tgl Lahir</td>
            <td class="separator">:</td>
            <td class="data">
                {{ $suratkeluar->tempat_lahir }} /
                {{ \Carbon\Carbon::parse($suratkeluar->tgl_lahir)->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="text-align: left;">Jenis Kelamin</td>
            <td class="separator">:</td>
            <td class="data">{{ $suratkeluar->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td style="text-align: left;">Agama</td>
            <td class="separator">:</td>
            <td class="data">{{ $suratkeluar->agama }}</td>
        </tr>
        <tr>
            <td style="text-align: left;">Pekerjaan</td>
            <td class="separator">:</td>
            <td class="data">{{ $suratkeluar->pekerjaan }}</td>
        </tr>
        <tr>
            <td style="text-align: left;">Nomor NIK/KK</td>
            <td class="separator">:</td>
            <td class="data">{{ $suratkeluar->nik }}</td>
        </tr>
        <tr>
            <td style="text-align: left;">Alamat</td>
            <td class="separator">:</td>
            <td class="data">{{ $suratkeluar->alamat }}</td>
        </tr>
    </table>

    <p class="left-margin-custom">Kel. Tobekgodang Kec. Binawidya</p>
    <p class="justify-text">
        <span class="span-first">Berdasarkan Surat Pengantar RT {{ $suratkeluar->rt }}/RW {{ $suratkeluar->rw }}
            Kelurahan Tobekgodang Kecamatan</span>
        <span class="span-second">Binawidya Kota Pekanbaru. Nama yang tersebut diatas benar berdomisili di
            {{ $suratkeluar->alamat }} RT </span>
        <span class="span-third">{{ $suratkeluar->rt }}/RW {{ $suratkeluar->rw }} Kelurahan Tobekgodang Kecamatan
            Binawidya Kota Pekanbaru. Surat keterangan</span>
        <span class="span-third"> ini digunakan untuk <b>{{ $suratkeluar->deskripsi }}</b>.</span>
    </p>
    <p>
        <span class="margin-large">
            Demikianlah surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana
        </span>
        <span class="margin-small">
            mestinya.
        </span>
    </p>

    <p class="align-right">
        Pekanbaru, {{ $today }}
    </p>
    <p class="text-right">Lurah Tobekgodang</p>
    <div class="text-right-1">
        <p class="bold-underline">YASIR ARAFAT, S.Sos</p>
    </div>
</body>

</html>
