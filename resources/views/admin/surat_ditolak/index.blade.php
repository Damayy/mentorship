@extends('layouts.main')
@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .modal-dialog {
            max-width: 50%;
        }

        .modal-content {
            border-radius: 0.3rem;
        }

        .modal-body {
            max-height: 500px;
            overflow-y: auto;
        }

        .center-align {
            text-align: center;
        }

        .btn-custom-small {
            font-size: 12px;
            /* Mengatur ukuran font */
            padding: 0.25rem 0.5rem;
            /* Mengatur padding untuk ukuran tombol */
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1 class="mt-4 text-center">Data Surat Yang Ditolak</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <div class="card-body">
                                    <table id="datasurat" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alasan Surat Ditolak</th>
                                                <th>Tanggal Surat Ditolak</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Nama Pengaju</th>
                                                <th>NIK</th>
                                                <th>Jenis Pengajuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($surattolak as $st)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $st->alasan_penolakan }}</td>
                                                    <td>{{ $st->tgl_surat_ditolak }}</td>
                                                    <td>{{ $st->pengajuansurat->tgl_pengajuan ?? 'Data tidak tersedia' }}
                                                    </td>
                                                    <td>{{ $st->pengajuansurat->nama_pengaju ?? 'Data tidak tersedia' }}
                                                    </td>
                                                    <td>{{ $st->pengajuansurat->nik ?? 'Data tidak tersedia' }}</td>
                                                    <td>{{ $st->pengajuansurat->jenis_pengajuan ?? 'Data tidak tersedia' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
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
            $('#datasurat').DataTable({
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
@endsection
