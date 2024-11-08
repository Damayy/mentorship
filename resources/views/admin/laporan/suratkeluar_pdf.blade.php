<!DOCTYPE html>
<html>

<head>
    <title>Laporan Surat Keluar</title>
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
    <h1>Laporan Surat Keluar</h1>
    <p>Bulan: {{ $bulan ? $bulan : 'Semua' }}</p>
    <p>Tahun: {{ $tahun ? $tahun : 'Semua' }}</p>
    <table>
        <thead>
            <tr>
                <th style="text-align: center; vertical-align: middle;">No</th>
                <th style="text-align: center; vertical-align: middle;">Nomor Surat</th>
                <th style="text-align: center; vertical-align: middle;">Tanggal Pengajuan</th>
                <th style="text-align: center; vertical-align: middle;">Tanggal Surat Dikeluarkan</th>
                <th style="text-align: center; vertical-align: middle;">Nama Pengaju</th>
                <th style="text-align: center; vertical-align: middle;">NIK</th>
                <th style="text-align: center; vertical-align: middle;">Jenis Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratKeluar as $suratK)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $suratK->nomor_surat }}</td>
                    <td>{{ $suratK->pengajuanSurat->tgl_pengajuan }}</td>
                    <td>{{ $suratK->tanggalsurat_keluar }}</td>
                    <td>{{ $suratK->nama_pengaju }}</td>
                    <td>{{ $suratK->nik }}</td>
                    <td>{{ $suratK->jenis_pengajuan }}</td>
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
