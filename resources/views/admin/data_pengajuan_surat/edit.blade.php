@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/tambah.css') }}">
    <div class="card mx-3 my-4">
        <div class="card-header">
            <h2 class="text-center mb-0">Form Edit data pengajuan surat</h2>
        </div>
        <div class="card-body">

            <form action="{{ route('datapengajuan.update', $datapengajuan->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                            <input id="tgl_pengajuan" name="tgl_pengajuan" type="date" class="form-control"
                                value="{{ $tanggal_hariini }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="text1">Nama Pengaju</label>
                            <input id="text1" name="nama_pengaju" type="text" class="form-control"
                                value="{{ $datapengajuan->nama_pengaju }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="text2">NIK</label>
                            <input id="text2" name="nik" type="number" class="form-control"
                                value="{{ $datapengajuan->nik }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="text2">Tempat Lahir</label>
                            <input id="text2" name="tempat_lahir" type="text" class="form-control"
                                value="{{ $datapengajuan->tempat_lahir }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="text2">Tanggal Lahir</label>
                            <input id="text2" name="tgl_lahir" type="date" class="form-control"
                                value="{{ $datapengajuan->tgl_lahir }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="select">Jenis Kelamin</label>
                            <select id="select" name="jenis_kelamin" class="form-select">
                                <option value="" disabled
                                    {{ old('jenis_kelamin', $datapengajuan->jenis_kelamin) === null ? 'selected' : '' }}>
                                    Pilih Jenis Kelamin</option>
                                <option value="laki-laki"
                                    {{ old('jenis_kelamin', $datapengajuan->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="perempuan"
                                    {{ old('jenis_kelamin', $datapengajuan->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="text2">Agama</label>
                            <input id="text2" name="agama" type="text" class="form-control"
                                value="{{ $datapengajuan->agama }}">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="text2">Pekerjaan</label>
                            <input id="text2" name="pekerjaan" type="text" class="form-control"
                                value="{{ $datapengajuan->pekerjaan }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="text2">Alamat</label>
                            <input id="text2" name="alamat" type="text" class="form-control"
                                value="{{ $datapengajuan->alamat }}">
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label" for="select">Jenis Pengajuan</label>
                            <div class="col-12">
                                <select id="select" name="jenis_pengajuan" class="custom-select" required="required">
                                    <option value=""></option>
                                    <option value="Surat Keterangan Belum Bekerja"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Belum Bekerja') selected @endif>
                                        Surat Keterangan Belum Bekerja
                                    </option>
                                    <option value="Surat Keterangan Belum Memiliki Rumah"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Belum Memiliki Rumah') selected @endif>
                                        Surat Keterangan Belum Memiliki Rumah
                                    </option>
                                    <option value="Surat Keterangan Belum Menikah"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Belum Menikah') selected @endif>
                                        Surat Keterangan Belum Menikah
                                    </option>
                                    <option value="Surat Keterangan Domisili"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Domisili') selected @endif>
                                        Surat Keterangan Domisili
                                    </option>
                                    <option value="Surat Keterangan Domisili Tanah"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Domisili Tanah') selected @endif>
                                        Surat Keterangan Domisili Tanah
                                    </option>
                                    <option value="Surat Keterangan Penghasilan"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Penghasilan') selected @endif>
                                        Surat Keterangan Penghasilan
                                    </option>
                                    <option value="Surat Keterangan Bersih Diri"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Bersih Diri') selected @endif>
                                        Surat Keterangan Bersih Diri
                                    </option>
                                    <option value="Surat Keterangan Catatan Sipil"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Catatan Sipil') selected @endif>
                                        Surat Keterangan Catatan Sipil
                                    </option>
                                    <option value="Surat Keterangan Duda" @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Duda') selected @endif>
                                        Surat Keterangan Duda
                                    </option>
                                    <option value="Surat Keterangan Janda"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Janda') selected @endif>
                                        Surat Keterangan Janda
                                    </option>
                                    <option value="Surat Keterangan Orang Yang Sama"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Orang Yang Sama') selected @endif>
                                        Surat Keterangan Orang Yang Sama
                                    </option>
                                    <option value="Surat Keterangan Ghoib"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Ghoib') selected @endif>
                                        Surat Keterangan Ghoib
                                    </option>
                                    <option value="Surat Keterangan Selesai Penelitian"
                                        @if ($datapengajuan->jenis_pengajuan == 'Surat Keterangan Selesai Penelitian') selected @endif>
                                        Surat Keterangan Selesai Penelitian
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="file">Upload Surat Pengantar RT/RW</label>
                            <input id="file" name="surat_pengantar" type="file" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="file">Upload Kartu Keluarga (KK)</label>
                            <input id="file" name="upload_kk" type="file" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="file">Upload Kartu Tanda Penduduk (KTP)</label>
                            <input id="file" name="upload_ktp" type="file" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-6 text-right">
                        <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
