@extends('layouts.main')
@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/tambah.css') }}">
    <style>
        .readonly-input[readonly] {
            background-color: #d3d3d3;
            /* Warna abu-abu */
            color: black;
            /* Warna teks abu-abu gelap */
        }

        .soft-gray-button {
            background-color: #d3d3d3;
            /* Warna abu-abu soft */
            color: black;
            /* Warna teks abu-abu gelap */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .soft-gray-button:hover {
            background-color: #c0c0c0;
            /* Warna abu-abu sedikit lebih gelap saat hover */
        }
    </style>

    <div class="card mx-3 my-4">
        <div class="card-header">
            <h2 class="text-center mb-0">Form Pengajuan Surat</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('pengajuan.simpandata') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                            <input id="tgl_pengajuan" name="tgl_pengajuan" type="date" class="form-control"
                                value="{{ $tanggal_hariini }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="text1">Nama Pengaju</label>
                            <input id="text1" name="nama_pengaju" type="text" class="form-control readonly-input"
                                value="{{ $namapengaju }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="text2">NIK</label>
                            <input id="text2" name="nik" type="number" class="form-control readonly-input"
                                value="{{ $nik }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input id="tempat_lahir" name="tempat_lahir" type="text" class="form-control readonly-input"
                                value="{{ $tempat_lahir }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                                class="form-control readonly-input" value="{{ $tanggal_lahir }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input id="jenis_kelamin" name="jenis_kelamin" type="text"
                                class="form-control readonly-input" value="{{ $jenis_kelamin }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="agama">Agama</label>
                            <input id="agama" name="agama" type="text" class="form-control readonly-input"
                                value="{{ $agama }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input id="pekerjaan" name="pekerjaan" type="text" class="form-control"
                                value="{{ $pekerjaan }}">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <input id="alamat" name="alamat" type="text" class="form-control"
                                value="{{ $alamat }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="text2">Isi RT</label>
                            <input id="text2" name="rt" type="text" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="text2">Isi RW</label>
                            <input id="text2" name="rw" type="text" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="select">Jenis Pengajuan</label>
                            <select id="select" name="jenis_pengajuan" class="form-select" required>
                                <option value=""></option>
                                <option value="Surat Keterangan Belum Bekerja">Surat Keterangan Belum Bekerja</option>
                                <option value="Surat Keterangan Belum Memiliki Rumah">Surat Keterangan Belum Memiliki Rumah
                                </option>
                                <option value="Surat Keterangan Belum Menikah">Surat Keterangan Belum Menikah</option>
                                <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                                <option value="Surat Keterangan Domisili Tanah">Surat Keterangan Domisili Tanah</option>
                                <option value="Surat Keterangan Penghasilan">Surat Keterangan Penghasilan</option>
                                <option value="Surat Keterangan Catatan Sipil">Surat Keterangan Catatan Sipil</option>
                                <option value="Surat Keterangan Duda">Surat Keterangan Duda</option>
                                <option value="Surat Keterangan Janda">Surat Keterangan Janda</option>
                                <option value="Surat Keterangan Ghoib">Surat Keterangan Ghoib</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="text2">Deskripsi</label>
                            <input id="text2" name="deskripsi" type="text" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="file"><b>Upload Surat Pengantar RT/RW</b> (Maks 2 MB)</label>
                            <input id="file" name="surat_pengantar" type="file" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="bukti_kk"><b>Upload Kartu Keluarga (KK)</b></label>
                            @if ($bukti_kk)
                                <a href="{{ asset('storage/' . $bukti_kk) }}" target="_blank"
                                    class="soft-gray-button">Lihat KK yang diupload</a>
                            @else
                                <p>Tidak ada KK yang diupload</p>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="bukti_ktp"><b>Upload Kartu Tanda Penduduk (KTP)</b></label>
                            @if ($bukti_ktp)
                                <a href="{{ asset('storage/' . $bukti_ktp) }}" target="_blank"
                                    class="soft-gray-button">Lihat KTP yang diupload</a>
                            @else
                                <p>Tidak ada KTP yang diupload</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-10 text-right">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-file-earmark-arrow-up"></i>
                            Buat Pengajuan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
