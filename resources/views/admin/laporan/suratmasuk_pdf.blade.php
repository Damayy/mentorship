<!DOCTYPE html>
<html>

<head>
    <title>Laporan Surat Masuk</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 2%;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 100px;
            /* Sesuaikan ukuran logo */
            height: auto;
            margin-right: 20px;
        }

        .kop-surat .text {
            text-align: center;
            flex-grow: 1;
        }

        /* Memastikan semua elemen h2 dan p dalam kop-surat menggunakan font-size dan font-weight yang sama */
        .kop-surat .text h2,
        .kop-surat .text p {
            margin: 0;
            font-weight: bold;
            font-size: 22px;
            /* Ukuran font yang sama untuk h2 dan p */
        }

        /* Khusus untuk elemen dengan kelas alamat, gunakan ukuran font lebih kecil */
        .kop-surat .text .alamat {
            font-size: 14px;
        }

        .kop-surat .text .line {
            border-top: 2px solid black;
            margin-top: 5px;
        }

        .header-img {
            width: 100%;
            height: auto;
            /* Menjaga rasio aspek gambar */
            /* Atur lebar gambar sesuai keinginan */
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/Kopsuratt.jpg') }}" class="header-img" alt="Kop Surat">
    </div>
    <h1>Laporan Surat Masuk</h1>
    <p>Bulan: {{ $bulan ? $bulan : 'Semua' }}</p>
    <p>Tahun: {{ $tahun ? $tahun : 'Semua' }}</p>
    <table>
        <thead>
            <tr>
                <th style="text-align: center; vertical-align: middle;">No</th>
                <th style="text-align: center; vertical-align: middle;">Tanggal Pengajuan</th>
                <th style="text-align: center; vertical-align: middle;">Nama Pengaju</th>
                <th style="text-align: center; vertical-align: middle;">NIK</th>
                <th style="text-align: center; vertical-align: middle;">Jenis Pengajuan</th>
                <th style="text-align: center; vertical-align: middle;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratMasuk as $suratM)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $suratM->tgl_pengajuan }}</td>
                    <td>{{ $suratM->nama_pengaju }}</td>
                    <td>{{ $suratM->nik }}</td>
                    <td>{{ $suratM->jenis_pengajuan }}</td>
                    <td>{{ $suratM->deskripsi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
