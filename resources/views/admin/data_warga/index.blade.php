@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .btn-small {
            padding: 5px 10px;
            /* Mengatur padding */
            font-size: 0.875rem;
            /* Mengatur ukuran font */
            border-radius: 0.25rem;
            /* Mengatur radius sudut */
        }

        .btn-orange {
            background-color: orange;
            /* Warna background orange */
            color: white;
            /* Warna teks putih */
            border: none;
            /* Menghilangkan border */
            padding: 5px 10px;
            /* Mengatur padding */
            font-size: 0.875rem;
            /* Mengatur ukuran font */
            border-radius: 0.25rem;
            /* Mengatur radius sudut */
        }
    </style>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <h1 class="mt-4 text-center">Data Warga</h1>
                        <p class="text-center">Data warga yang sudah login, dan melakukan pengajuan di SILAYSKELTBG</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datawarga" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Email</th>
                                                    <th>Nama</th>
                                                    <th>NIK</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Alamat</th>
                                                    <th>Bukti Upload KTP</th>
                                                    <th>Bukti Upload KK</th>
                                                    <th>Konfirmasi Akun</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $dw)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $dw->email }}</td>
                                                        <td>{{ $dw->name }}</td>
                                                        <td>{{ $dw->nik }}</td>
                                                        <td>{{ $dw->jenis_kelamin }}</td>
                                                        <td>{{ $dw->alamat }}</td>
                                                        <td align="center">
                                                            @if ($dw->bukti_ktp)
                                                                <a href="{{ asset('storage/' . $dw->bukti_ktp) }}"
                                                                    target="_blank">Bukti Upload KTP</a>
                                                            @else
                                                                Tidak ada KTP yang diupload
                                                            @endif
                                                        </td>
                                                        <td align="center">
                                                            @if ($dw->bukti_kk)
                                                                <a href="{{ asset('storage/' . $dw->bukti_kk) }}"
                                                                    target="_blank">Bukti Upload KK</a>
                                                            @else
                                                                Tidak ada KK yang diupload
                                                            @endif
                                                        </td>
                                                        <td align="center">
                                                            @if ($dw->is_active === 1)
                                                                <form action="{{ route('admin.deactivate', $dw->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger btn-small">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </form>
                                                                <button
                                                                    style="background-color: green; color: white; border: none; padding: 5px 10px; font-size: 0.875rem; border-radius: 0.25rem;"
                                                                    disabled>
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <form action="{{ route('admin.delete', $dw->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-warning btn-small"
                                                                        style="background-color: orange; border-color: orange;">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @elseif ($dw->is_active === 2)
                                                                <button
                                                                    style="background-color: gray; color: white; border: none; padding: 5px 10px; font-size: 0.875rem; border-radius: 0.25rem;"
                                                                    disabled>
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                                <button class="btn btn-primary btn-small"
                                                                    style="background-color: gray; color: white; border: none; padding: 5px 10px; font-size: 0.875rem; border-radius: 0.25rem;"
                                                                    disabled>
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <form action="{{ route('admin.delete', $dw->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-warning btn-small"
                                                                        style="background-color: orange; border-color: orange;">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.activate', $dw->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-small">
                                                                        <i class="fas fa-check"></i>
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('admin.deactivate', $dw->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger btn-small">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('admin.delete', $dw->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-warning btn-small"
                                                                        style="background-color: orange; border-color: orange;">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
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
            $('#datawarga').DataTable({
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
