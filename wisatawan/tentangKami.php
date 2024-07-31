<?php include 'layout/header.php'; ?>

<!-- Topbar Start -->
<div class="container-fluid bg-dark p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <!-- Konten Opsional di Kiri -->
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center mx-n2">
            </div>
        </div>
    </div>
</div>
<!-- Akhir Bagian Topbar -->

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <?php include 'layout/navbar.php'; ?>
</nav>

<!-- Bagian Utama -->
<div class="container mt-xl-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h6 class="text-primary">Jelajahi Pariwisata di Kecamatan X Koto</h6>
        <h1 class="mb-4">Tentang Kami</h1>
    </div>
</div>

<div class="container">
    <div class="accordion" id="accordionExample">
        <!-- Item Accordion 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Tentang Pariwisata
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Pariwisata adalah kegiatan melakukan perjalanan yang bertujuan untuk mendapatkan kesenangan, kepuasan, pengetahuan, perbaikan kesehatan, menikmati olahraga atau istirahat, menunaikan tugas, berziarah, dan tujuan lainnya. Saat ini, pengembangan dan promosi pariwisata menjadi salah satu fokus utama pemerintah untuk mendatangkan keuntungan yang besar.
                </div>
            </div>
        </div>

        <!-- Item Accordion 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Potensi Wisata Kecamatan X Koto
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Kecamatan X Koto memiliki potensi wisata yang luar biasa, mulai dari keindahan alam, peninggalan sejarah, keunikan adat istiadat hingga berbagai atraksi seni dan budaya yang menarik wisatawan, baik domestik maupun mancanegara. Namun, potensi besar ini belum diimbangi dengan langkah-langkah promosi yang memadai, sehingga Kecamatan X Koto belum dikenal luas oleh wisatawan karena minimnya informasi yang tersedia dan kurangnya kejelasan moda transportasi.
                </div>
            </div>
        </div>

        <!-- Item Accordion 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Minimnya Informasi Wisata
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Minimnya informasi mengenai pariwisata di Kecamatan X Koto menyebabkan kurangnya pengetahuan wisatawan akan tempat-tempat wisata di wilayah ini. Kurangnya media informasi pariwisata yang akurat juga menjadi faktor utama kurangnya kunjungan wisatawan ke Kecamatan X Koto.Untuk mewujudkan kebutuhan masyarakat akan informasi pariwisata peneliti memiliki gagasan untuk mengimplementasikan Sistem Informasi Pariwisata di Kecamatan X Koto.
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
