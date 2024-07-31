<?php

include 'layout/header.php';
include '../koneksi.php';

// Query to fetch data from the database
$sql = "SELECT * FROM TempatWisata";
$result = $koneksi->query($sql);
$wisatawanResult = $koneksi->query("SELECT idWisatawan, nama FROM wisatawan");
$tempatWisataResult = $koneksi->query("SELECT idTempatWisata, nama FROM tempatWisata");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? '';
    $idWisatawan = $_POST['idWisatawan'];
    $idTempatWisata = $_POST['idTempatWisata'];
    $rating = $_POST['rating'];
    $komentar = $_POST['komentar'];

    if (isset($_POST['create'])) {
        // Create new review
        $sql = "INSERT INTO Ulasan (idWisatawan, idTempatWisata, rating, komentar) VALUES ('$idWisatawan', '$idTempatWisata', '$rating', '$komentar')";
        if ($koneksi->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } elseif (isset($_POST['update'])) {
        // Update existing review
        $sql = "UPDATE Ulasan SET idWisatawan='$idWisatawan', idTempatWisata='$idTempatWisata', rating='$rating', komentar='$komentar' WHERE idUlasan=$id";
        if ($koneksi->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $koneksi->error;
        }
    }
}
?>
<style>
    .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    margin: 0 auto;
}

.rating input[type="radio"] {
    display: none;
}

.rating label {
    display: inline-block;
    cursor: pointer;
    font-size: 2rem;
    color: #ccc;
}

.rating input[type="radio"]:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: #f5b301;
}

</style>

<!-- Topbar Start -->
<div class="container-fluid bg-dark p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <!-- Optional Left Content -->
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center mx-n2">
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <?php include 'layout/navbar.php'; ?>
</nav>
<!-- Navbar End -->

<!-- Carousel Start -->
<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/img/1.jpg" class="d-block w-100" alt="First slide" style="height: 60vh;">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-1 display-md-2 display-lg-3 display-xl-4">Temukan Keindahan Alam X Koto</h1>
                <p>Sambutlah pesona alam yang menakjubkan di X Koto dengan pemandangan yang menawan dan kekayaan budaya yang tak tertandingi.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/2.jpg" class="d-block w-100" alt="Second slide" style="height: 60vh;">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-1 display-md-2 display-lg-3 display-xl-4">Jelajahi Sejarah dan Kebudayaan X Koto</h1>
                <p>Rasakan keajaiban sejarah dan kebudayaan di X Koto, tempat yang kaya akan warisan budaya yang menarik untuk dijelajahi.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/3.jpg" class="d-block w-100" alt="Third slide" style="height: 60vh;">
            <div class="carousel-caption text-center d-none d-md-block">
                <h4 class="display-1 display-md-2 display-lg-3 display-xl-4">Nikmati keindahan Perbukitan X Koto</h4>
                <p> Jelajahi puncak-puncak perbukitan X Koto yang menakjubkan, temukan keindahan alam yang memukau dan suasana yang tenang, cocok untuk petualangan yang mendalam di tengah alam.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">sebelum</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">lanjut</span>
    </button>
</div>
<!-- Carousel End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <div class="container py-xl-5">
                    <h5 class="text-primary text-center my-md-5">Jelajahi Keindahan Alam</h5>
                    <h1 class="text-dark text-center my-md-2">X Koto dalam Gambaran</h1>
                    <p class="text-center">Temukan pesona alam X Koto melalui pemandangan menakjubkan dan warisan budaya yang kaya.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-8 wow fadeIn" data-wow-delay="0.3s">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Lokasi Kami</h4>
                    </div>
                    <div class="card-body">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127020.6738326943!2d100.3029675!3d-0.4745618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd524fa8b2e761f%3A0x4039d80b2210fc0!2sKec.+Sepuluh+Koto%2C+Kabupaten+Tanah+Datar%2C+Sumatera+Barat!5e0!3m2!1sid!2sid!4v1701054428265!5m2!1sid!2sid" width="600" height="450" style="border: 0; width: 100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

// Query to fetch only the first record from the database
$sql = "SELECT * FROM TempatWisata LIMIT 1";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fotoTempat = json_decode($row['fotoTempat'], true);
?>
<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
    <div class="container about px-lg-0">
        <div class="row g-0 mx-lg-0">
            <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <?php
                    if (is_array($fotoTempat) && !empty($fotoTempat)) {
                        echo "<img class='position-absolute img-thumbnail w-100 h-100' src='../admin/" . htmlspecialchars($fotoTempat[0]) . "' style='object-fit: cover;' alt='About Image'>";
                    } else {
                        echo "<img class='position-absolute img-fluid w-100 h-100' src='assets/img/1.jpg' style='object-fit: cover;' alt='About Image'>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                <div class="p-lg-5 pe-lg-0">
                    <h6 class="text-primary"><?php echo htmlspecialchars($row['nama']); ?></h6>
                    <h1 class="mb-4">Menikmati Keindahan Alam di <?php echo htmlspecialchars($row['nama']); ?></h1>
                    <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                    <p><?php echo htmlspecialchars($row['informasi']); ?></p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Pemandangan alam yang mempesona</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Wisata kuliner khas daerah</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Lokasi yang mudah dijangkau</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {
    echo "<p>Tidak ada data yang ditemukan.</p>";
}
?>


<div class="container text-center my-5">
    <div class="container mt-xl-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Gallery</h6>
            <h1 class="mb-4">Wisata Kecamatan X Koto, Tanah Datar, Sumatera Barat</h1>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-3">
        <div class="col">
            <div class="gallery-item">
                <img src="assets/img/bg-1.jpg" class="img-fluid w-100" style="height: 22rem;" alt="Wisata 1">
                <div class="overlay">
                    <div class="overlay-text">Wisata 1</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="gallery-item">
                <img src="assets/img/bg-2.jpg" class="img-fluid w-100" style="height: 22rem;" alt="Wisata 2">
                <div class="overlay">
                    <div class="overlay-text">Wisata 2</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="gallery-item">
                <img src="assets/img/bg-3.jpg" class="img-fluid w-100" style="height: 22rem;" alt="Wisata 3">
                <div class="overlay">
                    <div class="overlay-text">Wisata 3</div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<div class="container-fluid bg-light overflow-hidden py-5 px-lg-0">
    <div class="container contact py-lg-5">
        <div class="text-center mb-5">
            <h6 class="text-primary">Kontak</h6>
            <h1 class="mb-4">Berikan Ulasan</h1>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-lg-8">
                <form id="ulasanForm" method="POST" action="">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="idWisatawan" class="form-label">ID Wisatawan</label>
                        <select class="form-control" id="idWisatawan" name="idWisatawan" required>
                            <?php
                            if ($wisatawanResult->num_rows > 0) {
                                while ($wisatawan = $wisatawanResult->fetch_assoc()) {
                                    echo "<option value='{$wisatawan['idWisatawan']}'>{$wisatawan['nama']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="idTempatWisata" class="form-label">ID Tempat Wisata</label>
                        <select class="form-control" id="idTempatWisata" name="idTempatWisata" required>
                            <?php
                            if ($tempatWisataResult->num_rows > 0) {
                                while ($tempatWisata = $tempatWisataResult->fetch_assoc()) {
                                    echo "<option value='{$tempatWisata['idTempatWisata']}'>{$tempatWisata['nama']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 start-0">
                        <label for="rating" class="form-label">Rating</label>
                        <div class="rating justify-content-end">
                            <input type="radio" name="rating" id="rating-5" value="5">
                            <label for="rating-5" class="star"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rating" id="rating-4" value="4">
                            <label for="rating-4" class="star"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rating" id="rating-3" value="3">
                            <label for="rating-3" class="star"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rating" id="rating-2" value="2">
                            <label for="rating-2" class="star"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rating" id="rating-1" value="1">
                            <label for="rating-1" class="star"><i class="fa fa-star"></i></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="komentar" class="form-label">Komentar</label>
                        <textarea class="form-control" id="komentar" name="komentar" required></textarea>
                    </div>
                    <button type="submit" name="create" id="createBtn" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Contact End -->

<?php
include 'layout/footer.php';
?>