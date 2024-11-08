@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/status.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/dashboard.css') }}">
    <style>
        .timeline {
            display: flex;
            align-items: center;
            justify-content: initial;
            position: relative;
            margin-bottom: 2%;
        }

        .timeline-step {
            display: flex;
            align-items: center;
            position: relative;
        }

        .timeline-step .btn {
            z-index: 2;
            text-align: center;
        }

        .timeline-step .btn .timeline-percentage {
            margin: 4px 0 0 0;
            /* Jarak antara teks dan persentase */
            font-size: 12px;
            /* Ukuran font persentase */
        }

        .line {
            position: absolute;
            height: 4px;
            background-color: black;
            z-index: 1;
            top: 50%;
            transform: translateY(-50%);
        }

        .line-1 {
            width: 80px;
            left: 100px;
        }

        .line-2 {
            width: 80px;
            left: 100px;
        }

        .line-3 {
            width: 80px;
            left: 150px;
        }

        .btn-small {
            padding: 5px 10px;
            /* Atur padding untuk memperkecil ukuran tombol */
            font-size: 12px;
            /* Atur ukuran font untuk memperkecil teks tombol */
            line-height: 1.5;
            /* Atur tinggi garis */
            border-radius: 7px;
            /* Atur sudut tombol */
        }

        .btn-process {
            padding: 5px 10px;
            font-size: 10px;
            line-height: 1.5;
            border-radius: 4px;
            background-color: #ffc107;
            color: #fff;
            display: inline-flex;
            align-items: center;
            border: none;
        }

        .btn-process i {
            margin-right: 5px;
            /* Memberikan jarak antara ikon dan teks */
        }

        .btn-success.btn-small i {
            margin-right: 4px;
            /* Memberikan jarak antara ikon dan teks */
            font-size: 12px;
            /* Mengatur ukuran font ikon agar sesuai dengan teks */
        }

        .progress-text {
            font-size: 0.875rem;
            /* Menyesuaikan ukuran font untuk persentase */
            color: #6c757d;
            /* Warna teks untuk persentase */
        }

        .modal-title {
            color: black;
            /* Mengatur warna teks menjadi hitam */
        }
    </style>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <section class="content">
                <div class="container-fluid">
                    <h1 class="mt-2 mb-1 text-center">Status Pengajuan Surat</h1>

                    <h6>Keterangan:</h6>
                    <p>* Dibawah ini merupakan gambaran alur timeline untuk melihat update status pengajuan</p>
                    <div class="timeline">
                        <div class="timeline-step">
                            <button type="submit" name="status" value="verifikasi_berkas"
                                class="btn btn-warning btn-small me-2">
                                <i class="fas fa-search"></i> Verifikasi Berkas
                                <p class="timeline-percentage">25%</p>
                            </button>
                            <div class="line line-1"></div>
                        </div>

                        <div class="timeline-step">
                            <button type="button" class="btn btn-info btn-small me-2" data-bs-toggle="modal"
                                data-bs-target="#modalPembuatanDokumen">
                                <i class="fas fa-file-alt"></i> Pembuatan Dokumen
                                <p class="timeline-percentage">50%</p>
                            </button>
                            <div class="line line-2"></div>
                        </div>

                        <div class="timeline-step">
                            <button type="submit" name="status" value="menunggu_disetujui_lurah"
                                class="btn btn-primary btn-small me-2">
                                <i class="fas fa-thumbs-up"></i> Menunggu Disetujui Lurah
                                <p class="timeline-percentage">75%</p>
                            </button>
                            <div class="line line-3"></div>
                        </div>

                        <div class="timeline-step">
                            <button type="submit" name="status" value="surat_selesai"
                                class="btn btn-success btn-small me-2">
                                <i class="fas fa-check"></i> Surat Selesai
                                <p class="timeline-percentage">100%</p>
                            </button>
                        </div>
                    </div>
                    <p><b>* Edit data pengajuan hanya bisa dilakukan ketika status belum berubah menjadi "verifikasi
                            berkas"</b>
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered text-center" id="statusdata" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Nama Pengaju</th>
                                                <th>NIK</th>
                                                <th>Jenis Pengajuan</th>
                                                <th>Opsi</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Resi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengajuansurat as $ps)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $ps->tgl_pengajuan }}</td>
                                                    <td>{{ $ps->nama_pengaju }}</td>
                                                    <td>{{ $ps->nik }}</td>
                                                    <td>{{ $ps->jenis_pengajuan }}</td>
                                                    {{-- Logic untuk Edit Data --}}
                                                    <td>
                                                        @if (is_null($ps->status) || empty($ps->status))
                                                            <!-- Jika status NULL atau kosong, tombol bisa diklik -->
                                                            <a href="{{ route('pengajuan.edit', $ps->id) }}"
                                                                class="edit-btn">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @elseif (
                                                            $ps->status == 'verifikasi_berkas' ||
                                                                $ps->status == 'pembuatan_dokumen' ||
                                                                $ps->status == 'disetujui_lurah' ||
                                                                $ps->status == 'surat_selesai')
                                                            <!-- Jika status Verifikasi Berkas, Pembuatan Dokumen, Disetujui Lurah, atau Surat Selesai, tombol tidak bisa diklik -->
                                                            <a href="#" class="edit-btn disabled"
                                                                style="pointer-events: none; opacity: 0.6;">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @else
                                                            <!-- Default jika status tidak sesuai dengan kondisi di atas -->
                                                            <a href="#" class="edit-btn disabled"
                                                                style="pointer-events: none; opacity: 0.6;">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{-- Logika untuk status --}}
                                                        @if ($ps->status == 'verifikasi_berkas')
                                                            <button type="button"
                                                                class="btn btn-warning btn-small d-block w-100">
                                                                Verifikasi Berkas
                                                            </button>
                                                            <div class="progress-text text-center mt-2">25%</div>
                                                        @elseif ($ps->status == 'pembuatan_dokumen')
                                                            <button type="button"
                                                                class="btn btn-info btn-small d-block w-100">
                                                                Pembuatan Dokumen
                                                            </button>
                                                            <div class="progress-text text-center mt-2">50%</div>
                                                        @elseif ($ps->status == 'menunggu_disetujui_lurah')
                                                            <button type="button"
                                                                class="btn btn-primary btn-small d-block w-100">
                                                                Menunggu Disetujui Lurah
                                                            </button>
                                                            <div class="progress-text text-center mt-2">75%</div>
                                                        @elseif ($ps->status == 'surat_selesai')
                                                            <button type="button"
                                                                class="btn btn-success btn-small d-block w-100">
                                                                Surat Selesai
                                                            </button>
                                                            <div class="progress-text text-center mt-2">100%</div>
                                                        @elseif ($ps->status == 'ditolak_admin')
                                                            <button type="button"
                                                                class="btn btn-danger btn-small d-block w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalAlasanPenolakan-{{ $ps->id }}">
                                                                Ditolak oleh Admin
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-secondary btn-small d-block w-100">
                                                                Menunggu status berikutnya...
                                                            </button>
                                                            <div class="progress-text text-center mt-2"></div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ps->status == 'surat_selesai')
                                                            <span><em>Surat sudah bisa diambil di kantor lurah</em></span>
                                                        @elseif ($ps->status == 'ditolak_admin')
                                                            <span><em>Silahkan ajukan surat kembali serta perbaiki kesalahan
                                                                    sebelumnya</em></span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ps->status == 'surat_selesai')
                                                            <a href="{{ route('pengajuansurat.resi.pdf', $ps->id) }}"
                                                                class="btn btn-primary"
                                                                style="padding: 0.25rem 0.5rem; font-size: 0.75rem; line-height: 1.25; border-radius: 0.5rem;">
                                                                No Resi
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <!-- Modal untuk alasan_penolakan -->
                                                    <div class="modal fade" id="modalAlasanPenolakan-{{ $ps->id }}"
                                                        tabindex="-1" aria-labelledby="modalAlasanPenolakanLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="modalAlasanPenolakanLabel">
                                                                        Alasan Penolakan Pengajuan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if ($ps->suratditolak)
                                                                        <p>{{ $ps->suratditolak->alasan_penolakan }}</p>
                                                                    @else
                                                                        <p>Data penolakan belum tersedia.</p>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal untuk menampilkan Resi-->
                                                    <div class="modal fade modal-bg-image" id="resiModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="resiModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="resiModalLabel"><b>Nomor
                                                                            Resi</b>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p id="resiNumber">Nomor Resi: <strong></strong></p>
                                                                    <p id="nama">Nama: <strong></strong></p>
                                                                    <p id="jenisPengajuan">Jenis Pengajuan:
                                                                        <strong></strong>
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
    <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/dist/js/demo.js"></script>
    <script>
        $(document).ready(function() {
            $('#statusdata').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('modalAlasanPenolakan');
            modal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button yang memicu modal
                var alasan = button.getAttribute('data-alasan'); // Ambil alasan penolakan dari data atribut

                var modalBody = modal.querySelector('#alasanPenolakanText');
                modalBody.textContent = alasan ? alasan : 'Tidak ada alasan penolakan yang diberikan.';
            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#resiModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var pengajuanId = button.data('id'); // Ambil ID dari atribut data-id

                $.ajax({
                    url: '/get-resi-number/' + pengajuanId,
                    type: 'GET',
                    success: function(data) {
                        console.log('Data dari server:', data);
                        $('#resiNumber strong').text(data.resi ||
                            'Nomor resi tidak ditemukan.');
                        $('#nama strong').text(data.nama_pengaju || 'Nama tidak ditemukan.');
                        $('#jenisPengajuan strong').text(data.jenis_pengajuan ||
                            'Jenis pengajuan tidak ditemukan.');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        $('#resiNumber strong').text('Terjadi kesalahan.');
                        $('#nama strong').text('Terjadi kesalahan.');
                        $('#jenisPengajuan strong').text('Terjadi kesalahan.');
                    }
                });
            });
        });
    </script>
@endsection
