@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/dashboard.css') }}">
    <style>
        /* CSS untuk tombol biru dengan latar belakang biru */
        .info-button-blue {
            background-color: darkcyan;
            /* Warna biru */
            color: #fff;
            /* Warna teks putih */
            border: none;
            /* Menghapus border default */
            padding: 10px 15px;
            /* Padding tombol */
            border-radius: 5px;
            /* Sudut tombol melengkung */
            font-size: 19px;
            /* Ukuran font */
            line-height: 1.5;
            /* Tinggi garis */
            cursor: pointer;
            /* Tampilkan kursor pointer */
            display: inline-block;
            /* Agar tombol berperilaku sebagai inline-block */
            text-align: left;
            /* Teks diatur rata kiri */
            width: 100%;
            /* Lebar tombol 100% */
            margin-bottom: 20px;
        }

        .info-button-blue .icon {
            margin-right: 8px;
            /* Jarak antara ikon dan teks */
        }

        .info-button-blue p {
            margin: 0;
            /* Menghapus margin default dari <p> */
            font-size: 16px;
            /* Ukuran font untuk teks dalam tombol */
        }

        /* CSS untuk tombol merah muda dengan latar belakang merah muda */
        .info-button-pink {
            background-color: #f8d7da;
            /* Warna merah muda */
            color: #721c24;
            /* Warna teks merah gelap */
            border: none;
            /* Menghapus border default */
            padding: 10px 15px;
            /* Padding tombol */
            border-radius: 5px;
            /* Sudut tombol melengkung */
            font-size: 19px;
            /* Ukuran font */
            line-height: 1.5;
            /* Tinggi garis */
            cursor: pointer;
            /* Tampilkan kursor pointer */
            display: inline-block;
            /* Agar tombol berperilaku sebagai inline-block */
            text-align: left;
            /* Teks diatur rata kiri */
            width: 100%;
            /* Lebar tombol 100% */
        }

        .info-button-pink .icon {
            margin-right: 8px;
            /* Jarak antara ikon dan teks */
        }

        .info-button-pink p {
            margin: 0;
            /* Menghapus margin default dari <p> */
            font-size: 16px;
            /* Ukuran font untuk teks dalam tombol */
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang {{ Auth::user()->name }}</li>
        </ol>
        <button class="info-button-blue">
            <i class="fas fa-info-circle icon"></i>
            Keterangan
            <p>1. Saudara/i wajib memperhatikan syarat untuk melakukan pengajuan</p>
            <p> <b>Upload foto (Surat Pengantar RT/RW, Kartu Keluarga, Kartu Tanda Penduduk)</b></p>
            <p>2. Pengajuan surat hanya dapat dilakukan oleh masyarakat Kelurahan Tobekgodang</p>
        </button>
        <br>
        <button class="info-button-pink">
            <i class="fas fa-info-circle icon"></i>
            Pengajuan Surat
            <p>1. Pilih pengajuan surat</p>
            <p>2. Isi form data pengajuan</p>
            <p>3. Tunggu perubahan pada status pengajuan</p>
            <p>4. Jika status <b>Surat Selesai 100%</b>, maka surat sudah bisa diambil di Kantor Lurah Tobekgodang</p>
            <p>5. Untuk mengambil surat di kantor lurah, jangan lupa membawa/menunjukkan Resi saudara/i <b>(cek Resi pada
                    status pengajuan)</b>
            </p>
            <p>6. Jika surat <b>Ditolak oleh admin</b>, periksa alasan penolakan, kemudian perbaiki, dan lakukan pengajuan
                surat kembali.</p>
            <p><em>*isilah data dengan benar dan sesuai</em></p>
        </button>
        <!-- Timeline Proses -->
        <div class="pt-4">
            {{-- <div class="container"> --}}
            <h4 class="fw-bold text-dark">Alur Pelayanan Pengajuan Surat</h4>
            <p class="text-muted mb-0">Alur proses pelayanan yang akan dilalui oleh warga</p>
            {{-- </div> --}}
            <!-- Timeline Besar -->
            <section class="ps-timeline-sec d-none d-md-block">
                <div class="container">
                    <ol class="ps-timeline">
                        <li>
                            <div class="img-handler">
                                <img src="{{ asset('AdminLTE/image/buat.png') }}" alt="Pengajuan" />
                            </div>
                            <div class="ps-content">
                                <h5 class="text-dark fw-bold">Pengajuan</h5>
                                <p>Warga melakukan pengajuan pada website SILAYSKELTBG</p>
                            </div>
                            <span class="ps-step">01</span>
                        </li>
                        <li>
                            <div class="img-handler">
                                <img src="{{ asset('AdminLTE/image/verifikasi.png') }}" alt="Verifikasi Berkas" />
                            </div>
                            <div class="ps-content">
                                <h5 class="text-dark fw-bold">Verifikasi Berkas</h5>
                                <p>Proses verifikasi berkas pengajuan yang sudah dilampirkan oleh staff admin kantor
                                </p>
                            </div>
                            <span class="ps-step">02</span>
                        </li>
                        <li>
                            <div class="img-handler">
                                <img src="{{ asset('AdminLTE/image/proses.png') }}" alt="Pembuatan Dokumen" />
                            </div>
                            <div class="ps-content">
                                <h5 class="text-dark fw-bold">Pembuatan Dokumen</h5>
                                <p>Proses pembuatan dokumen surat oleh staff admin kantor</p>
                            </div>
                            <span class="ps-step">03</span>
                        </li>
                        <li>
                            <div class="img-handler">
                                <img src="{{ asset('AdminLTE/image/proses.png') }}" alt="Selesai" />
                            </div>
                            <div class="ps-content">
                                <h5 class="text-dark fw-bold">Disetujui Lurah</h5>
                                <p>Menunggu Dokumen surat ditandatangani oleh Lurah
                                </p>
                            </div>
                            <span class="ps-step">04</span>
                        </li>
                        <li>
                            <div class="img-handler">
                                <img src="{{ asset('AdminLTE/image/kirim.png') }}" alt="Selesai" />
                            </div>
                            <div class="ps-content">
                                <h5 class="text-dark fw-bold">Selesai</h5>
                                <p>Surat selesai dan warga sudah bisa mengambil surat di Kantor Lurah sesuai dengan jam
                                    kerja
                                </p>
                            </div>
                            <span class="ps-step">05</span>
                        </li>
                    </ol>
                </div>
            </section>
        </div>
    @endsection
