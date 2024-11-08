<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .nav-link {
        display: flex;
        align-items: center;
    }

    .notif-badge {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 10px;
        margin-left: 8px;
        /* Jarak antara teks dan notifikasi */
        font-weight: bold;
    }
</style>
@php
    $datapengajuan = DB::table('pengajuansurat')->count();
    $suratditolakadmin = DB::table('suratditolak')->count();
    $suratygdikeluarkan = DB::table('suratkeluar')->count();
    $jumlahWarga = DB::table('users')->where('role', 'warga')->count();
@endphp

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    @if (Auth::user()->role === 'admin')
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>
                    @elseif(Auth::user()->role === 'warga')
                        <a class="nav-link" href="{{ route('warga.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>
                    @endif
                    @if (Auth::user()->role == 'admin')
                        <div class="sb-sidenav-menu-heading">Informasi</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Master Data
                            <span class="notif-badge">{{ $jumlahWarga }}</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                {{-- <a class="nav-link" href="#">Data Pengajuan</a> --}}
                                <a class="nav-link" href="{{ route('datawarga') }}">Data Warga</a>
                                <a class="nav-link" href="{{ route('dataadmin') }}">Data Admin</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="{{ route('laporansurat') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt nav-icon"></i></div>
                            Laporan
                        </a>
                        <div class="sb-sidenav-menu-heading">Surat</div>
                        <a class="nav-link" href="{{ route('suratmasuk') }}">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-envelope-arrow-down-fill"></i>
                            </div>
                            Surat Masuk
                            <span class="notif-badge">{{ $datapengajuan }}</span>
                        </a>
                        <a class="nav-link" href="{{ route('suratditolak.index') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-envelope-x-fill"></i></div>
                            Surat Ditolak
                            <span class="notif-badge">{{ $suratditolakadmin }}</span>
                        </a>
                        <a class="nav-link" href="{{ route('suratkeluar.index') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-envelope-arrow-up-fill"></i></div>
                            Surat Keluar
                            <span class="notif-badge">{{ $suratygdikeluarkan }}</span>
                        </a>
                    @endif
                    @if (Auth::user()->role == 'warga')
                        <div class="sb-sidenav-menu-heading">Pelayanan</div>
                        <a class="nav-link" href="{{ route('pengajuan.tambah') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt nav-icon"></i></div>
                            Pengajuan Surat
                        </a>
                        <a class="nav-link" href="{{ route('pengajuan.riwayatdata') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-envelope-exclamation-fill"></i></div>
                            Riwayat Data
                        </a>
                        <a class="nav-link" href="{{ route('pengajuan.status') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clock-history"></i></div>
                            Status Pengajuan
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <mai>
