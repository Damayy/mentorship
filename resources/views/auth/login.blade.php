<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SILAYSKELTBG</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/login.css') }}">
    <style>
        .red-link {
            color: red;
            /* Mengubah warna teks link menjadi merah */
        }

        .login-box {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            /* Background putih untuk keseluruhan box */
        }

        .login-left,
        .login-right {
            width: 50%;
            padding: 20px;
            background-color: #fff;
            /* Background putih untuk masing-masing bagian */
        }

        .login-left {
            text-align: center;
        }

        .login-left img {
            margin-bottom: 20px;
        }

        .login-left .card-header {
            border: none;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .background {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="login-box">
            <div class="login-left">
                <div class="text-center mt-3">
                    <img class="text-center" src="{{ asset('AdminLTE') }}/dist/img/logo.jpg" alt="Tobekgodanglogo"
                        height="100" width="80">
                </div>
                <div class="card-header text-center">
                    <a class="h1"><b>SI-LSM</b></a>
                    <h4><b>Kelurahan Tobekgodang</b></h4>
                </div>
                <p class="mb-0">Sistem Informasi Layanan Surat</p>
                <p>Kelurahan Tobekgodang</p>
                <p><a href="{{ route('beranda') }}"><i class="fas fa-arrow-left"></i> Beranda</a></p>
            </div>
            <div class="login-right">
                <div class="card-body">
                    <p class="login-box-msg"></p>
                    <form action="{{ route('proses-masuk') }}" method="post">
                        @csrf

                        @if ($errors->has('failed'))
                            <div class="alert alert-danger">
                                {{ $errors->first('failed') }}
                            </div>
                        @endif

                        @error('nik')
                            <small>{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="nama">Nomor Induk Kependudukan (NIK)</label>
                            <div class="input-group mb-3">
                                <!-- Ubah bagian ini dengan tidak menambahkan old('email') -->
                                <input type="nik" name="nik" class="form-control"
                                    placeholder="Masukkan NIK Anda">
                                <div class="input-group-append"></div>
                            </div>
                        </div>

                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="nama">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Isi Password">
                                <div class="input-group-append"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-center mt-2">Belum punya akun? <a href="{{ route('daftar') }}"
                                    class="red-link">Daftar</a> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif


    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif

</body>

</html>
