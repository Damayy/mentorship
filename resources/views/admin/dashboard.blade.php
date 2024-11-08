@extends('layouts.main')
@section('content')
    {{-- <link rel="stylesheet" href="{{ asset('AdminLTE/css/dashboard.css') }}"> --}}
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang {{ Auth::user()->name }}</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <span>Surat Masuk:</span>
                        <h4 class="mb-0">{{ $datapengajuan }}</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('suratmasuk') }}">
                            Lihat Detail
                        </a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <span>Surat Ditolak:</span>
                        <h4 class="mb-0">{{ $surattolak }}</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('suratditolak.index') }}">
                            Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <span>Surat Keluar:</span>
                        <h4 class="mb-0">{{ $suratKeluar }}</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('suratkeluar.index') }}">
                            Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <span>Data Warga:</span>
                        <h4 class="mb-0">{{ $jumlahWarga }}</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('datawarga') }}">
                            Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-4">
        <div class="row">
            <!-- Bar Chart untuk Jenis Pengajuan -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart - Jumlah Jenis Pengajuan
                    </div>
                    <div class="card-body">
                        <canvas id="pengajuanBarChart" width="100%" height="50"></canvas>
                        <!-- Tinggi dikurangi menjadi 100 -->
                    </div>
                    <div class="card-footer small text-muted">Updated at {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
                    </div>
                </div>
            </div>

            <!-- Pie Chart untuk Distribusi Gender atau data lain -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Pie Chart - Perbandingan Jumlah Data Berdasarkan Pengajuan
                    </div>
                    <div class="card-body">
                        <canvas id="pengajuanPieChart" width="100%" height="330"></canvas>
                        <!-- Tinggi dikurangi menjadi 100 -->
                    </div>
                    <div class="card-footer small text-muted">Updated at {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk Bar Chart
        const labels = [
            @foreach ($jenisPengajuanCounts as $pengajuan)
                "{{ $pengajuan->jenis_pengajuan }}",
            @endforeach
        ];

        const barChartData = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [
                    @foreach ($jenisPengajuanCounts as $pengajuan)
                        {{ $pengajuan->total }},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const barChartConfig = {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pengajuan'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Jenis Pengajuan'
                        }
                    }
                }
            }
        };

        const pengajuanBarChart = new Chart(
            document.getElementById('pengajuanBarChart'),
            barChartConfig
        );

        // Data untuk Pie Chart
        const pieChartData = {
            labels: ['Laki-Laki', 'Perempuan'],
            datasets: [{
                label: 'Distribusi Gender',
                data: [
                    @foreach ($genderCounts as $gender)
                        {{ $gender->total }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        };

        const pieChartConfig = {
            type: 'pie',
            data: pieChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' ';
                            }
                        }
                    }
                },
                aspectRatio: 1, // Mengatur rasio aspek untuk membuat pie chart lebih kecil
                maintainAspectRatio: false, // Mengizinkan kontrol ukuran dengan CSS
            }
        };

        const pengajuanPieChart = new Chart(
            document.getElementById('pengajuanPieChart'),
            pieChartConfig
        );
    </script>
@endsection
