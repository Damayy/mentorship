<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak | SILAYSKELTBG</title>
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/css/lokasi.css') }}">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="header-content">
                <div class="image">
                    <img src="{{ asset('AdminLTE/image/logo.jpg') }}" class="elevation-0" alt="User Image">
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
            <div class="auth-links-container">
                <a href="{{ route('masuk') }}" class="auth-link login-link">Masuk</a>
                <a href="{{ route('daftar') }}" class="auth-link register-link">Daftar</a>
            </div>
        </nav>
    </header>

    <div class="background">
        <div class="contact-in">
            <div class="contact-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6859616260285!2d101.40026040000001!3d0.46670079999999653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a8ee2b6ff38b%3A0x5a02d36d4ef02c72!2sKantor%20Lurah%20Tobek%20Godang!5e0!3m2!1sid!2sid!4v1720710175041!5m2!1sid!2sid"
                    width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="contact">
                <h1>Contact Us</h1>
                <div class="contact-details">
                    <p class="contact-detail"><strong>Lokasi</strong></p>
                    <p class="contact-detail">Kantor Lurah Tobek Godang</p>
                    <p class="contact-detail">Jl. Damai No.22, Delima</p>
                    <p class="contact-detail">Kec.Tampan</p>
                    <p class="contact-detail">Kota Pekanbaru</p>
                    <p class="contact-detail">Riau</p>
                    <p class="contact-detail">28292</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5">
        <div class="footer-down bg-darker text-white px-5 py-3">
            <div class="container-fluid">
                <div class="row text-center>
                    <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="copyright">
                        <strong>Sistem Informasi Layanan Surat Kelurahan Tobekgodang</strong>
                    </div>
                    <div class="credits">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="social-links float-end">
                        <a href="#" class="mx-2">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="#" class="mx-2">
                            <i class="fab fa-twitter fa-2x"></i>
                        </a>
                        <a href="#" class="mx-2">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="#" class="mx-2">
                            <i class="fab fa-youtube fa-2x"></i>
                        </a>
                        <a href="#" class="mx-2">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>

</body>

</html>
