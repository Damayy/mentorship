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

        /* Warna default untuk tombol Diterima dan Ditolak */
        .btn-custom-small {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 4px;
            border: none;
        }

        /* Tombol Diterima saat aktif */
        .btn-success {
            background-color: #28a745;
            color: white;
        }

        /* Tombol Ditolak saat aktif */
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        /* Tombol setelah di-disable */
        .btn-disabled {
            background-color: #ccc;
            color: #fff;
            cursor: not-allowed;
        }

        /* Modifikasi tambahan untuk efek hover */
        .btn-success:hover,
        .btn-danger:hover {
            opacity: 0.8;
        }

        .btn-disabled:hover {
            opacity: 1;
            /* Nonaktifkan efek hover pada tombol disabled */
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1 class="mt-4 text-center">Data Surat Masuk</h1>
                <p class="text-center">Data pengajuan surat oleh warga</p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <div class="card-body">
                                    <table id="datasurat" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Nama Pengaju</th>
                                                <th>NIK</th>
                                                <th>Detail</th>
                                                <th>Jenis Pengajuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengajuansurat as $sm)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $sm->tgl_pengajuan }}</td>
                                                    <td>{{ $sm->nama_pengaju }}</td>
                                                    <td>{{ $sm->nik }}</td>
                                                    <td class="center-align">
                                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                            data-bs-target="#modalDetail"
                                                            data-tempat-lahir="{{ $sm->tempat_lahir }}"
                                                            data-tanggal-lahir="{{ $sm->tgl_lahir }}"
                                                            data-jenis-kelamin="{{ $sm->jenis_kelamin }}"
                                                            data-agama="{{ $sm->agama }}"
                                                            data-pekerjaan="{{ $sm->pekerjaan }}"
                                                            data-alamat="{{ $sm->alamat }}"
                                                            data-rt="{{ $sm->rt }}" data-rw="{{ $sm->rw }}"
                                                            data-deskripsi="{{ $sm->deskripsi }}"
                                                            data-upload-surat-pengantar="{{ $sm->surat_pengantar ? asset('storage/' . $sm->surat_pengantar) : '#' }}"
                                                            data-upload-kk="{{ $sm->upload_kk ? asset('storage/' . $sm->upload_kk) : '#' }}"
                                                            data-upload-ktp="{{ $sm->upload_ktp ? asset('storage/' . $sm->upload_ktp) : '#' }}">
                                                            <i class=""></i> Detail
                                                        </button>
                                                    </td>
                                                    <td>{{ $sm->jenis_pengajuan }}</td>
                                                    <td align="center">
                                                        <button type="button" class="btn btn-primary btn-small"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalUpdateStatus-{{ $sm->id }}">
                                                            Konfirmasi
                                                        </button>
                                                    </td>
                                                    <!-- Modal Konfirmasi status-->
                                                    <div class="modal fade" id="modalUpdateStatus-{{ $sm->id }}"
                                                        tabindex="-1" aria-labelledby="modalUpdateStatusLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalUpdateStatusLabel">
                                                                        Update Status Pengajuan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('suratmasuk.updateStatus', $sm->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="d-flex justify-content-between">
                                                                            <button type="submit" name="status"
                                                                                value="verifikasi_berkas"
                                                                                class="btn btn-warning btn-small me-2"
                                                                                {{ in_array($sm->status, ['verifikasi_berkas', 'pembuatan_dokumen', 'menunggu_disetujui_lurah', 'surat_selesai', 'ditolak_admin']) ? 'disabled' : '' }}>
                                                                                <i class="fas fa-search"></i> Verifikasi
                                                                                Berkas
                                                                            </button>

                                                                            <button type="button"
                                                                                class="btn btn-info btn-small me-2"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modalPembuatanDokumen-{{ $sm->id }}"
                                                                                {{ in_array($sm->status, ['pembuatan_dokumen', 'menunggu_disetujui_lurah', 'surat_selesai', 'ditolak_admin']) || $sm->status != 'verifikasi_berkas' ? 'disabled' : '' }}>
                                                                                <i class="fas fa-file-alt"></i> Pembuatan
                                                                                Dokumen
                                                                            </button>

                                                                            <button type="submit" name="status"
                                                                                value="menunggu_disetujui_lurah"
                                                                                class="btn btn-primary btn-small me-2"
                                                                                {{ in_array($sm->status, ['menunggu_disetujui_lurah', 'surat_selesai', 'ditolak_admin']) || $sm->status != 'pembuatan_dokumen' ? 'disabled' : '' }}>
                                                                                <i class="fas fa-thumbs-up"></i> Menunggu
                                                                                Disetujui Lurah
                                                                            </button>

                                                                            <button type="submit" name="status"
                                                                                value="surat_selesai"
                                                                                class="btn btn-success btn-small me-2"
                                                                                {{ $sm->status != 'menunggu_disetujui_lurah' || $sm->status == 'surat_selesai' || $sm->status == 'ditolak_admin' ? 'disabled' : '' }}>
                                                                                <i class="fas fa-check"></i> Surat Selesai
                                                                            </button>

                                                                            <button type="button"
                                                                                class="btn btn-danger btn-small me-2"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modalDitolakAdmin-{{ $sm->id }}"
                                                                                {{ in_array($sm->status, ['pembuatan_dokumen', 'menunggu_disetujui_lurah', 'surat_selesai', 'ditolak_admin']) ? 'disabled' : '' }}>
                                                                                <i class="fas fa-times"></i> Ditolak oleh
                                                                                Admin
                                                                            </button>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Pembuatan Dokumen suratkeluar-->
                                                    <div class="modal fade" id="modalPembuatanDokumen-{{ $sm->id }}"
                                                        tabindex="-1" aria-labelledby="modalPembuatanDokumenLabel"
                                                        aria-hidden="true">
                                                        {{-- <div class="modal-dialog modal-sm">
                                                            <!-- Cara 1: Menggunakan modal-sm --> --}}
                                                        <div class="modal-dialog" style="max-width: 500px;">
                                                            <!-- Cara 2: CSS Kustom -->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalPembuatanDokumenLabel">
                                                                        Konfirmasi Pembuatan Dokumen Surat Keluar
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('suratkeluar.simpan') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="pengajuansurat_id"
                                                                            value="{{ $sm->id }}">

                                                                        <div class="mb-3">
                                                                            <label for="tanggalsurat_keluar"
                                                                                class="form-label">Tanggal Surat
                                                                                Keluar</label>
                                                                            <input type="date" class="form-control"
                                                                                id="tanggalsurat_keluar"
                                                                                name="tanggalsurat_keluar" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="nomor_surat"
                                                                                class="form-label">Nomor Surat</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control"
                                                                                    id="nomor_surat-{{ $sm->id }}"
                                                                                    name="nomor_surat" readonly>
                                                                                <button type="button"
                                                                                    class="btn btn-danger generateNomorSurat"
                                                                                    data-id="{{ $sm->id }}">Nomor
                                                                                    Surat</button>
                                                                            </div>
                                                                        </div>

                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal untuk surat ditolak-->
                                                    <div class="modal fade" id="modalDitolakAdmin-{{ $sm->id }}"
                                                        tabindex="-1" aria-labelledby="modalDitolakAdminLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalDitolakAdminLabel">
                                                                        Konfirmasi Status Penolakan Surat</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('suratditolak.store') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="pengajuansurat_id"
                                                                            value="{{ $sm->id }}">

                                                                        <!-- Tanggal Surat Ditolak -->
                                                                        <div class="mb-3">
                                                                            <label for="tgl_surat_ditolak"
                                                                                class="form-label">Tanggal Surat
                                                                                Ditolak</label>
                                                                            <input type="date" class="form-control"
                                                                                id="tgl_surat_ditolak"
                                                                                name="tgl_surat_ditolak" required>
                                                                        </div>
                                                                        <!-- Alasan Penolakan -->
                                                                        <div class="mb-3">
                                                                            <label for="alasan_penolakan"
                                                                                class="form-label">Berikan alasan penolakan
                                                                                disini</label>
                                                                            <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" rows="3" required></textarea>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Simpan</button>
                                                                    </form>
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
            </div>
        </section>
    </div>

    <!-- Modal Detail HTML -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Data Pengajuan</h5>
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
                    <p><a id="upload-surat-pengantar" href="#" target="_blank">Lihat Upload Surat Pengantar</a></p>

                    <p><strong>Upload KK:</strong></p>
                    <p><a id="upload-kk" href="#" target="_blank">Lihat Upload Kartu Keluarga (KK)</a></p>

                    <p><strong>Upload KTP:</strong></p>
                    <p><a id="upload-ktp" href="#" target="_blank">Lihat Upload Kartu Tanda Penduduk (KTP)</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <script>
        document.querySelectorAll('.generateNomorSurat').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nomorSuratInput = document.getElementById('nomor_surat-' + id);

                // Melakukan request ke server untuk mendapatkan nomor surat
                fetch(`/generate-nomor-surat`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nomor_surat) {
                            nomorSuratInput.value = data.nomor_surat;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
    {{-- <script>
        document.querySelectorAll('.generateNomorSurat').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nomorSuratInput = document.getElementById('nomor_surat-' + id);

                // Generate nomor surat dengan format angka dari 001
                const nomorSurat = '001'; // Ganti sesuai dengan logic nomor surat yang Anda inginkan.
                nomorSuratInput.value = nomorSurat;
            });
        });
    </script> --}}
    {{-- <script>
        document.getElementById('generateNomorSurat').addEventListener('click', function() {
            // Generate nomor surat dengan format angka dari 001
            const nomorSurat = '001'; // Anda bisa mengganti logika ini jika ingin nomor dinamis
            document.getElementById('nomor_surat').value = nomorSurat;
        });
    </script> --}}
@endsection
