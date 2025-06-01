<?php
    session_start();
    include 'connection.php';
    if (!isset($_SESSION['user_id'])) {
        $userLogin = FALSE;
    } else {
        $userLogin = TRUE;
    }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tekkom Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
        body {
            background-color: #121212;
            color: #f5f5f5;
            scroll-behavior: smooth;
        }

        nav {
            background-color: #1E1E1E;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .hero {
            background-image: url('assets/bg-music.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            padding: 120px 0;
            position: relative;
            text-align: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .btn-orange {
            background-color: #FF7043;
            color: white;
            transition: 0.3s;
        }

        .btn-orange:hover {
            background-color: #E64A19;
        }

        .card {
            background-color: #1f1f1f;
            color: white;
            border: none;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 4px 20px rgba(255, 112, 67, 0.2);
        }

        img.studio-img {
            border-radius: 1rem;
            width: 100%;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }

        .gallery-img {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }

        section {
            scroll-margin-top: 80px;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/logo.png" alt="Logo" width="40" height="40" class="me-2" />
                Tekkom Studio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#harga">Harga</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pesan">Pesan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <!-- before login -->
                    <?php if(!$userLogin): ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <!-- after login -->
                    <?php else: ?>
                    <li class="nav-item dropdown">
                        <button class="btn nav-link dropdown-toggle" style="border: none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>Akun
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="user/userProfile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="booking/bookingForm.php">Booking</a></li>
                            <li><a class="dropdown-item" href="user/userHistory.php">History</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero text-white">
        <div class="overlay"></div>
        <div class="container">
            <h1 class="display-4" data-aos="fade-up">Selamat Datang di Tekkom Studio</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Studio musik terbaik untuk latihan dan produksi Anda</p>
            <a href="booking/bookingForm.php" class="btn btn-orange btn-lg mt-3" data-aos="zoom-in" data-aos-delay="200">Pesan Sekarang!</a>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-5 bg-black">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6" data-aos="fade-right">
                    <h2>Tentang Kami</h2>
                    <p>
                        Tekkom Studio adalah ruang kreatif bagi para musisi untuk berlatih dan bereksperimen. Dengan fasilitas
                        modern dan suasana nyaman, kami mendukung setiap proses kreatif Anda.
                    </p>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <img src="assets/studio.jpg" class="studio-img" alt="Studio Kami">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Layanan Kami</h2>
            <div class="row text-center g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card p-4 h-100">
                        <i class="bi bi-mic-fill fs-1 text-warning mb-3"></i>
                        <h5>Alat Musik Lengkap</h5>
                        <p>Drum, gitar, keyboard, dan ampli siap digunakan.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card p-4 h-100">
                        <i class="bi bi-volume-up-fill fs-1 text-info mb-3"></i>
                        <h5>Ruangan Akustik</h5>
                        <p>Ruang kedap suara dengan peredam profesional.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card p-4 h-100">
                        <i class="bi bi-calendar-check-fill fs-1 text-success mb-3"></i>
                        <h5>Jadwal Fleksibel</h5>
                        <p>Booking studio sesuai kebutuhan Anda, tanpa ribet.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Harga -->
    <section id="harga" class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Harga Sewa Studio</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="zoom-in">
                    <div class="card text-center p-4 h-100">
                        <h5 class="mb-3">Studio Reguler</h5>
                        <h3 class="text-warning">Rp 50.000/jam</h3>
                        <p>Untuk latihan band atau individu</p>
                        <a href="booking/bookingForm.php" class="btn btn-orange mt-3">
                            Pesan Sekarang!
                        </a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card text-center p-4 h-100">
                        <h5 class="mb-3">Studio Premium</h5>
                        <h3 class="text-info">Rp 100.000/jam</h3>
                        <p>Fasilitas lengkap + rekaman</p>
                        <a href="booking/bookingForm.php" class="btn btn-orange mt-3">
                            Pesan Sekarang!
                        </a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card text-center p-4 h-100">
                        <h5 class="mb-3">Studio VIP</h5>
                        <h3 class="text-success">Rp 150.000/jam</h3>
                        <p>Cocok untuk produksi intensif</p>
                        <a href="booking/bookingForm.php" class="btn btn-orange mt-3">
                            Pesan Sekarang!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section id="galeri" class="py-5 bg-dark">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Galeri Studio</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="assets/1.jpg" class="gallery-img" alt="Studio 1">
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <img src="assets/2.jpeg" class="gallery-img" alt="Studio 2">
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets/3.jpeg" class="gallery-img" alt="Studio 3">
                </div>
            </div>
        </div>
    </section>

    <!-- Pesan -->
    <section id="pesan" class="py-5 bg-black text-white">
        <div class="container text-center" data-aos="fade-up">
            <h2 class="mb-4">Tunggu Apalagi?</h2>
            <p>Pilih studio-mu Sekarang!</p>
            <a href="booking/bookingForm.php" class="btn btn-orange mt-3 col-md-4">
                Pesan
            </a>
        </div>
    </section>

    <!-- Testimoni Carousel -->
    <section id="testimoni" class="py-5 bg-black text-white">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Apa Kata Mereka?</h2>
            <div id="carouselTestimoni" class="carousel slide" data-bs-ride="carousel" data-aos="zoom-in">
                <div class="carousel-inner">
                    <div class="carousel-item active text-center">
                        <blockquote class="blockquote">
                            <p class="mb-4">"Tempatnya nyaman banget! Alatnya lengkap dan stafnya ramah. Recommended!"</p>
                            <footer class="blockquote-footer text-white-50">Andi, Gitaris</footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item text-center">
                        <blockquote class="blockquote">
                            <p class="mb-4">"Suara di ruangan kedapnya mantap. Kami sering rekaman di sini."</p>
                            <footer class="blockquote-footer text-white-50">Rina, Vokalis</footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item text-center">
                        <blockquote class="blockquote">
                            <p class="mb-4">"Pelayanan sangat cepat dan profesional. Studio andalan kami!"</p>
                            <footer class="blockquote-footer text-white-50">Bagas, Drummer</footer>
                        </blockquote>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimoni" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimoni" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-5 text-white">
        <div class="container text-center" data-aos="fade-up">
            <h2 class="mb-4">Hubungi Kami</h2>
            <p>Untuk pertanyaan lebih lanjut, hubungi kami melalui:</p>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-orange mt-3">
                <i class="bi bi-whatsapp me-2"></i>Chat via WhatsApp
            </a>
            <a href="mailto:tekkomstudio@email.com" class="btn btn-outline-light mt-3 ms-2">
                <i class="bi bi-envelope-fill me-2"></i>Kirim Email
            </a>
        </div>
    </section>

    <!-- Lokasi -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4" data-aos="fade-up">Lokasi Studio Kami</h2>
            <div class="ratio ratio-16x9" data-aos="zoom-in">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5872786007394!2d107.72293907503214!3d-6.939828293060184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c323777ca3a1%3A0x355eff6734ed9167!2sUniversitas%20Pendidikan%20Indonesia%20-%20Kampus%20UPI%20Cibiru!5e0!3m2!1sen!2sid!4v1748754164602!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 bg-dark text-white">
        <p>© 2025 Tekkom Studio. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>