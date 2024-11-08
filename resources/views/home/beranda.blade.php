<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | SILAYSKELTBG</title>
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/dashboard.css') }}">
    <style>
        .logo-size {
            width: 40px;
            height: auto;
        }

        .auth-link {
            display: inline-block;
            margin: 10px;
            padding: 15px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            width: 100px;
            text-align: center;
        }

        .login-link {
            background-color: #ff0000;
        }

        .login-link:hover {
            background-color: #cc0000;
        }

        .register-link {
            background-color: #1a5da5;
        }

        .register-link:hover {
            background-color: #0056b3;
        }

        .content h1,
        .content h2,
        .content h4 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="header-content">
                <div class="image">
                    <img src="{{ asset('AdminLTE/image/logo.jpg') }}" class="elevation-0 logo-size" alt="User Image">
                </div>
                <div class="info">
                    <p class="d-block"><strong>Kelurahan Tobekgodang</strong></p>
                    <p class="d-block city">Kota Pekanbaru</p>
                </div>
            </div>
            <ul>
                <li><a href="{{ route('beranda') }}">Beranda</a></li>
                <li><a href="{{ route('informasi.layanan') }}">Informasi Layanan</a></li>
                <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
            </ul>
        </nav>
        <div class="background-index">
            <div class="content-index">
                <h1><strong>Selamat Datang !</strong></h1>
                <h1>"SI-LSM"</h1>
                <h2><strong>Sistem Informasi Layanan Surat Menyurat Kelurahan Tobekgodang</strong></h2>
                <a href="{{ route('masuk') }}" class="auth-link login-link">Masuk</a>
                <a href="{{ route('daftar') }}" class="auth-link register-link">Daftar</a>
            </div>
        </div>
    </header>
</body>

</html>
