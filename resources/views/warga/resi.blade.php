<!DOCTYPE html>
<html>

<head>
    <title>Resi Surat Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            position: relative;
            margin-top: 5%;
        }

        .header,
        .footer {
            text-align: center;
            position: center;
            width: 100%;
            left: 0;
            padding: 3px;
        }

        .header img {
            max-width: 100%;
            /* Mengatur gambar agar responsif */
            height: auto;
            /* Memastikan tinggi gambar sesuai dengan proporsi */
        }

        .footer {
            bottom: 0;
            font-size: 12px;
        }

        .content {
            position: center;
        }

        .content-box {
            background: url("public/images/print.jpg") no-repeat center center;
            background-size: cover;
            padding: 20px;
            border-radius: 10px;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            background: darkgray;
        }

        th {
            background-color: cornflowerblue;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/Kopsuratt.jpg') }}" class="header-img" alt="Kop Surat">
        <h2>Resi Surat</h2>
        <h4>Dibawa saat mengambil surat di Kantor Lurah Tobekgodang</h4>
    </div>

    <div class="container">
        <table>
            <tr>
                <th>Nomor Resi</th>
                <td>{{ $resi }}</td>
            </tr>
            <tr>
                <th>Nomor Induk Kependudukan (NIK)</th>
                <td>{{ $nik }}</td>
            </tr>
            <tr>
                <th>Nama Pengaju</th>
                <td>{{ $nama_pengaju }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $jenis_kelamin }}</td>
            </tr>
            <tr>
                <th>Jenis Pengajuan</th>
                <td>{{ $jenis_pengajuan }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Layanan Surat Kelurahan Tobekgodang. Kota Pekanbaru - &copy; {{ date('Y') }} </p>
    </div>
</body>

</html>
