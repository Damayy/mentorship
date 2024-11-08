<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi | SILAYSKELTBG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/informasi.css') }}">
    <style>
        .content-wrapper {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
            color: black;
            margin-top: 8%;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="header-content">
                <div class="image">
                    <img src="{{ asset('AdminLTE/image/logo.jpg') }}" class="elevation-0" alt="User Image">
                </div>
                <div class="info">
                    <p class="d-block"><strong>Kelurahan Tobekgodang</strong></p>
                    <p class="d-block city">Kota Pekanbaru</p>
                </div>
            </div>
            <ul>
                <li><a href="{{ route('beranda') }}">Beranda</a></li>
                <li><a href="{{ route('informasi.layanan') }}">Informasi Layanan</a></li>
                <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
            </ul>
            <div class="auth-links-container">
                <a href="{{ route('masuk') }}" class="auth-link login-link">Masuk</a>
                <a href="{{ route('daftar') }}" class="auth-link register-link">Daftar</a>
            </div>
        </nav>
        <div class="background">
            <div class="container">
                <!-- Wrapper for white background -->
                <div class="content-wrapper">
                    <!-- Timeline Proses -->
                    <div class="pt-4">
                        <h3 class="fw-bold text-dark">Alur Pelayanan Pengajuan Surat</h3>
                        <p class="text-muted mb-0">Alur proses pelayanan yang akan dilalui oleh warga</p>

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
                                            <img src="{{ asset('AdminLTE/image/verifikasi.png') }}"
                                                alt="Verifikasi Berkas" />
                                        </div>
                                        <div class="ps-content">
                                            <h5 class="text-dark fw-bold">Verifikasi Berkas</h5>
                                            <p>Proses verifikasi berkas pengajuan yang sudah dilampirkan oleh staff
                                                admin kantor
                                            </p>
                                        </div>
                                        <span class="ps-step">02</span>
                                    </li>
                                    <li>
                                        <div class="img-handler">
                                            <img src="{{ asset('AdminLTE/image/proses.png') }}"
                                                alt="Pembuatan Dokumen" />
                                        </div>
                                        <div class="ps-content">
                                            <h5 class="text-dark fw-bold">Pembuatan Dokumen</h5>
                                            <p>Proses pembuatan dokumen surat oleh staff admin kantor</p>
                                        </div>
                                        <span class="ps-step">03</span>
                                    </li>
                                    <li>
                                        <div class="img-handler">
                                            <img src="{{ asset('AdminLTE/image/proses.png') }}"
                                                alt="Disetujui Lurah" />
                                        </div>
                                        <div class="ps-content">
                                            <h5 class="text-dark fw-bold">Disetujui Lurah</h5>
                                            <p>Menunggu dokumen surat ditandatangani oleh Lurah</p>
                                        </div>
                                        <span class="ps-step">04</span>
                                    </li>
                                    <li>
                                        <div class="img-handler">
                                            <img src="{{ asset('AdminLTE/image/kirim.png') }}" alt="Selesai" />
                                        </div>
                                        <div class="ps-content">
                                            <h5 class="text-dark fw-bold">Selesai</h5>
                                            <p>Surat selesai dan warga sudah bisa mengambil surat di Kantor Lurah sesuai
                                                dengan jam kerja</p>
                                        </div>
                                        <span class="ps-step">05</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>
