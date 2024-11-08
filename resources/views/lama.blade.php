<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SILAYSKELTBG</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/login.css') }}">
    <style>
        .background {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f7f7f7;
        }

        .register-box {
            display: flex;
            justify-content: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 1000px;
            max-width: 1000px;
        }

        .register-content {
            width: 100%;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-group {
            width: 10%;
            /* Mengatur lebar masing-masing kolom */
        }

        .text-center img {
            margin-bottom: 10px;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .info-button {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background-color: #e9ecef;
            border: none;
            padding: 10px;
            border-radius: 5px;
            color: #333;
        }

        .info-button .icon {
            margin-right: 5px;
        }
    </style>

</head>

<body class="hold-transition login-page">
    <div class="background">
        <div class="register-box">
            <div class="text-center mt-3">
                <img class="text-center" src="{{ asset('AdminLTE') }}/dist/img/logo.jpg" alt="Tobekgodanglogo"
                    height="60" width="50">
                <h4><b>Daftar Akun</b></h4>
            </div>
            <div class="register-content">
                <form action="{{ route('proses-daftar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <button class="info-button">
                            <i class="fas fa-info-circle icon"></i>
                            Isilah data anda sesuai dengan KTP ataupun KK
                        </button>
                    </div>

                    <!-- Row 1 -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Isi Nama Lengkap"
                                value="{{ old('nama') }}">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Masukkan Alamat Email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select id="pekerjaan" name="pekerjaan" class="form-control"
                                onchange="toggleLainnyaInput(this)">
                                <option value="" disabled selected>Pilih Pekerjaan</option>
                                <optgroup label="Pemerintahan">
                                    <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil (PNS)</option>
                                    <option value="Tni">TNI</option>
                                    <option value="Polri">Polri</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Dosen">Dosen</option>
                                </optgroup>
                                <optgroup label="Swasta">
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Manajer">Manajer</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Teknisi">Teknisi</option>
                                    <option value="Marketing">Marketing</option>
                                </optgroup>
                                <optgroup label="BUMN/BUMD">
                                    <option value="Karyawan BUMN">Karyawan BUMN</option>
                                    <option value="Karyawan BUMD">Karyawan BUMD</option>
                                </optgroup>
                                <optgroup label="Wirausaha">
                                    <option value="Pengusaha">Pengusaha</option>
                                    <option value="Pedagang">Pedagang</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Pemilik Ukm">Pemilik UKM</option>
                                </optgroup>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <!-- Input tambahan untuk pekerjaan lainnya -->
                        <div class="form-group col-md-4" id="pekerjaan-lainnya-group" style="display: none;">
                            <label for="pekerjaan-lainnya">Sebutkan Pekerjaan Lainnya</label>
                            <input type="text" id="pekerjaan-lainnya" name="pekerjaan_lainnya" class="form-control"
                                placeholder="Masukkan Pekerjaan Anda">
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK"
                                value="{{ old('nik') }}">
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"
                                placeholder="Isi Tempat Lahir">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="agama">Agama</label>
                            <select id="agama" name="agama" class="form-control">
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Protestan">Kristen</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Isi Password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                placeholder="Tanggal Lahir">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bukti_ktp">Upload KTP</label>
                            <input type="file" name="bukti_ktp" class="form-control"
                                accept=".jpg,.jpeg,.png,.pdf">
                            @error('bukti_ktp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 4: Upload Files -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Konfirmasi Password">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="bukti_kk">Upload KK</label>
                            <input type="file" name="bukti_kk" class="form-control"
                                accept=".jpg,.jpeg,.png,.pdf">
                            @error('bukti_kk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger btn-block">Daftar Akun</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <p>Sudah punya akun? Silahkan <a href="{{ route('masuk') }}" class="red-link">Masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
        function toggleLainnyaInput(select) {
            var lainnyaInput = document.getElementById('pekerjaan-lainnya');
            lainnyaInput.style.display = select.value === 'lainnya' ? 'block' : 'none';
        }
    </script> --}}
    <script>
        function toggleLainnyaInput(select) {
            var lainnyaInput = document.getElementById('pekerjaan-lainnya-group');
            if (select.value === 'lainnya') {
                lainnyaInput.style.display = 'block';
            } else {
                lainnyaInput.style.display = 'none';
            }
        }
    </script>

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif
</body>

</html>
