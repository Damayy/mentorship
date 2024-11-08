@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Laporan Surat</h1>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $activeTab == 'surat-masuk' ? 'active' : '' }}"
                    href="{{ route('laporansurat', ['tab' => 'surat-masuk']) }}" role="tab">
                    Surat Masuk
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $activeTab == 'surat-keluar' ? 'active' : '' }}"
                    href="{{ route('laporansurat', ['tab' => 'surat-keluar']) }}" role="tab">
                    Surat Keluar
                </a>
            </li>
        </ul>
        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Surat Masuk Tab -->
            <div class="tab-pane fade {{ $activeTab == 'surat-masuk' ? 'show active' : '' }}" id="surat-masuk"
                role="tabpanel" aria-labelledby="surat-masuk-tab">
                <form action="{{ route('laporansurat', ['tab' => 'surat-masuk']) }}" method="GET" class="mt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="bulan_masuk">Bulan</label>
                            <select id="bulan_masuk" name="bulan" class="form-select">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>Januari</option>
                                <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>Februari</option>
                                <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret</option>
                                <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei</option>
                                <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni</option>
                                <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli</option>
                                <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>Agustus</option>
                                <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun_masuk">Tahun</label>
                            <input id="tahun_masuk" name="tahun" type="number" class="form-control" placeholder="YYYY"
                                value="{{ request('tahun') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="{{ route('laporansurat') }}?bulan={{ request('bulan') }}&tahun={{ request('tahun') }}&export=pdf"
                                class="btn btn-danger">Ekspor PDF</a>
                        </div>
                    </div>
                </form>
                <!-- Display Filtered Data -->
                @if (isset($suratMasuk) && $suratMasuk->count())
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Nama Pengaju</th>
                                <th>NIK</th>
                                <th>Jenis Pengajuan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratMasuk as $suratM)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $suratM->tgl_pengajuan }}</td>
                                    <td>{{ $suratM->nama_pengaju }}</td>
                                    <td>{{ $suratM->nik }}</td>
                                    <td>{{ $suratM->jenis_pengajuan }}</td>
                                    <td>{{ $suratM->deskripsi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Surat Keluar Tab -->
            <div class="tab-pane fade {{ $activeTab == 'surat-keluar' ? 'show active' : '' }}" id="surat-keluar"
                role="tabpanel" aria-labelledby="surat-keluar-tab">
                <form action="{{ route('laporansurat', ['tab' => 'surat-keluar']) }}" method="GET" class="mt-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="bulan_keluar">Bulan</label>
                            <select id="bulan_keluar" name="bulan" class="form-select">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>Januari</option>
                                <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>Februari</option>
                                <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret</option>
                                <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei</option>
                                <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni</option>
                                <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli</option>
                                <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>Agustus</option>
                                <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun_keluar">Tahun</label>
                            <input id="tahun_keluar" name="tahun" type="number" class="form-control" placeholder="YYYY"
                                value="{{ request('tahun') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="{{ route('laporansurat', ['tab' => 'surat-keluar', 'bulan' => request('bulan'), 'tahun' => request('tahun'), 'export' => 'pdf']) }}"
                                class="btn btn-danger">Ekspor PDF</a>
                        </div>
                    </div>
                </form>
                <!-- Display Filtered Data -->
                @if (isset($suratKeluar) && $suratKeluar->count())
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Dikeluarkan</th>
                                <th>Nama Pengaju</th>
                                <th>NIK</th>
                                <th>Jenis Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratKeluar as $suratK)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $suratK->nomor_surat }}</td>
                                    <td>{{ $suratK->pengajuanSurat->tgl_pengajuan }}</td>
                                    <td>{{ $suratK->tanggalsurat_keluar }}</td>
                                    <td>{{ $suratK->nama_pengaju }}</td>
                                    <td>{{ $suratK->nik }}</td>
                                    <td>{{ $suratK->jenis_pengajuan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
