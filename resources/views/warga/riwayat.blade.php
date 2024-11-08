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
                <h1 class="mt-4 text-center">Riwayat Data Pengajuan</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <div class="card-body">
                                    <table id="informasidata" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Nama Pengaju</th>
                                                <th>NIK</th>
                                                <th>Jenis Pengajuan</th>
                                                <th>Detail</th>
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
                                                    <td class="center-align">
                                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                            data-bs-target="#modalDetail"
                                                            data-tempat-lahir="{{ $ps->tempat_lahir }}"
                                                            data-tanggal-lahir="{{ $ps->tgl_lahir }}"
                                                            data-jenis-kelamin="{{ $ps->jenis_kelamin }}"
                                                            data-agama="{{ $ps->agama }}"
                                                            data-pekerjaan="{{ $ps->pekerjaan }}"
                                                            data-alamat="{{ $ps->alamat }}"
                                                            data-rt="{{ $ps->rt }}" data-rw="{{ $ps->rw }}"
                                                            data-deskripsi="{{ $ps->deskripsi }}"
                                                            data-upload-surat-pengantar="{{ $ps->surat_pengantar ? asset('storage/' . $ps->surat_pengantar) : '#' }}"
                                                            data-upload-kk="{{ $ps->upload_kk ? asset('storage/' . $ps->upload_kk) : '#' }}"
                                                            data-upload-ktp="{{ $ps->upload_ktp ? asset('storage/' . $ps->upload_ktp) : '#' }}">
                                                            <i></i> Detail
                                                        </button>
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
        <!-- Modal Detail HTML -->
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel">Detail Informasi Data Pengajuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Tempat Lahir:</strong> <span id="tempat-lahir"></span></p>
                        <p><strong>Tanggal Lahir:</strong> <span id="tanggal-lahir"></span></p>
                        <p><strong>Jenis Kelamin:</strong> <span id="jenis-kelamin"></span></p>
                        <p><strong>Agama:</strong> <span id="agama"></span></p>
                        <p><strong>Pekerjaan:</strong> <span id="pekerjaan"></span></p>
                        <p><strong>Alamat:</strong> <span id="alamat"></span></p>
                        <p><strong>RT:</strong> <span id="rt"></span></p>
                        <p><strong>RW:</strong> <span id="rw"></span></p>
                        <p><strong>Deskripsi:</strong> <span id="deskripsi"></span></p>
                        <p><strong>Upload Surat Pengantar:</strong></p>
                        <p><a id="upload-surat-pengantar" href="#" target="_blank">Lihat Surat Pengantar</a></p>

                        <p><strong>Upload KK:</strong></p>
                        <p><a id="upload-kk" href="#" target="_blank">Lihat Upload KK</a></p>

                        <p><strong>Upload KTP:</strong></p>
                        <p><a id="upload-ktp" href="#" target="_blank">Lihat Upload KTP</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
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
            $('#informasidata').DataTable({
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
        $(document).ready(function() {
            $('#modalDetail').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var tempatLahir = button.data('tempat-lahir'); // Extract info from data-* attributes
                var tanggalLahir = button.data('tanggal-lahir');
                var jenisKelamin = button.data('jenis-kelamin');
                var agama = button.data('agama');
                var pekerjaan = button.data('pekerjaan');
                var alamat = button.data('alamat');
                var rt = button.data('rt');
                var rw = button.data('rw');
                var deskripsi = button.data('deskripsi');
                var uploadSuratPengantar = button.data('upload-surat-pengantar');
                var uploadKk = button.data('upload-kk');
                var uploadKtp = button.data('upload-ktp');

                // Update the modal's content.
                var modal = $(this);
                modal.find('#tempat-lahir').text(tempatLahir);
                modal.find('#tanggal-lahir').text(tanggalLahir);
                modal.find('#jenis-kelamin').text(jenisKelamin);
                modal.find('#agama').text(agama);
                modal.find('#pekerjaan').text(pekerjaan);
                modal.find('#alamat').text(alamat);
                modal.find('#rt').text(rt);
                modal.find('#rw').text(rw);
                modal.find('#deskripsi').text(deskripsi);
                modal.find('#upload-surat-pengantar').attr('href', uploadSuratPengantar);
                modal.find('#upload-kk').attr('href', uploadKk);
                modal.find('#upload-ktp').attr('href', uploadKtp);
            });
        });
    </script>
@endsection
