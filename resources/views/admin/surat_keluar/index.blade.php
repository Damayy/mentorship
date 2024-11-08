@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .btn-print {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            /* Adjust padding as needed */
            font-size: 12px;
            /* Adjust font size */
            line-height: 1.5;
            border-radius: 4px;
            /* Rounded corners */
            background-color: #3a96f8;
            /* Button color (blue) */
            color: #fff;
            /* Text color (white) */
            border: none;
            /* Remove border */
            cursor: pointer;
            /* Pointer cursor on hover */
            transition: background-color 0.3s ease;
            /* Smooth background color transition */
        }

        .btn-print i {
            margin-right: 5px;
            /* Space between icon and text */
        }

        .btn-print:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }

        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }
    </style>
    {{-- Pastikan CSRF Token Ada di Halaman Blade --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <h1 class="mt-4 text-center">Data Surat Keluar</h1>
                        <p class="text-center">Data pengajuan surat yang sudah diterima oleh Admin (nomor surat dan tgl
                            surat dikeluarkan)</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datasuratkeluar" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Surat Keluar</th>
                                                    <th>Nomor Surat</th>
                                                    <th>Nama Pengaju</th>
                                                    <th>NIK</th>
                                                    <th>Jenis Pengajuan</th>
                                                    <th>Detail</th>
                                                    <th>No Resi</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($suratKeluar as $sK)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $sK->tanggalsurat_keluar }}</td>
                                                        <td>{{ $sK->nomor_surat }}</td>
                                                        <td>{{ $sK->pengajuansurat->nama_pengaju ?? 'Data tidak tersedia' }}
                                                        </td>
                                                        <td>{{ $sK->pengajuansurat->nik ?? 'Data tidak tersedia' }}
                                                        </td>
                                                        <td>{{ $sK->pengajuansurat->jenis_pengajuan ?? 'Data tidak tersedia' }}
                                                        </td>
                                                        <td align="center">
                                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#detailModal{{ $sK->id }}">Detail</button>
                                                        </td>
                                                        <td align="center">
                                                            @if (empty($sK->resi))
                                                                <button class="btn btn-danger"
                                                                    style="padding: 5px 10px; font-size: 12px;"
                                                                    data-id="{{ $sK->id }}"
                                                                    onclick="generateResi(this)">
                                                                    No Resi
                                                                </button>
                                                            @else
                                                                <span class="resi-number">{{ $sK->resi }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (empty($sK->resi))
                                                                <button class="btn btn-print" disabled>
                                                                    <i class="bi bi-printer"></i>Print
                                                                </button>
                                                            @else
                                                                <button class="btn btn-print"
                                                                    onclick="window.location.href='{{ route('suratkeluar.print', ['id' => $sK->id]) }}'">
                                                                    <i class="bi bi-printer"></i>Print
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Button Detail -->
                                                    <div class="modal fade" id="detailModal{{ $sK->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="detailModalLabel{{ $sK->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="detailModalLabel{{ $sK->id }}">Detail
                                                                        Informasi Surat Keluar</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Tempat Lahir:</strong>
                                                                        {{ $sK->pengajuansurat->tempat_lahir ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Tanggal Lahir:</strong>
                                                                        {{ $sK->pengajuansurat->tgl_lahir ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Agama:</strong>
                                                                        {{ $sK->pengajuansurat->agama ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Alamat:</strong>
                                                                        {{ $sK->pengajuansurat->alamat ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Alamat:</strong>
                                                                        {{ $sK->pengajuansurat->rt ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Alamat:</strong>
                                                                        {{ $sK->pengajuansurat->rw ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Pekerjaan:</strong>
                                                                        {{ $sK->pengajuansurat->pekerjaan ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Jenis Kelamin:</strong>
                                                                        {{ $sK->pengajuansurat->jenis_kelamin ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Jenis Pengajuan:</strong>
                                                                        {{ $sK->pengajuansurat->jenis_pengajuan ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                    <p><strong>Deskripsi:</strong>
                                                                        {{ $sK->pengajuansurat->deskripsi ?? 'Data tidak tersedia' }}
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">No data available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>
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
            $('#datasuratkeluar').DataTable({
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
    {{-- <script>
        function generateResi(button) {
            // Ambil ID dari tombol yang diklik
            const id = $(button).data('id');

            // Kirim permintaan ke server untuk menghasilkan nomor resi
            $.ajax({
                url: '/admin/suratkeluar/generateResi/', // URL untuk menyimpan data
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}' // Token CSRF
                },
                success: function(response) {
                    // Ganti tombol dengan nomor resi yang dihasilkan
                    $(button).replaceWith(`<span class="resi-number">${response.resiNumber}</span>`);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }
    </script> --}}
    <script>
        function generateResi(button) {
            const suratKeluarId = button.getAttribute('data-id');

            fetch(`/admin/suratkeluar/generateResi/${suratKeluarId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.resiNumber) {
                        // Gantikan tombol dengan nomor resi yang dihasilkan
                        button.parentElement.innerHTML = `<span class="resi-number">${data.resiNumber}</span>`;
                    } else {
                        alert('Gagal menghasilkan nomor resi. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
        }
    </script>
@endsection
