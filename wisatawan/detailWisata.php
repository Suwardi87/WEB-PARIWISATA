<?php
include 'layout/header.php';
include '../koneksi.php';

if (isset($_GET['id'])) {
    $idTempatWisata = $_GET['id'];
    $sql = "SELECT * FROM TempatWisata WHERE idTempatWisata = $idTempatWisata";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Decode JSON string to array for 'fotoTempat'
        $fotoTempat = json_decode($row['fotoTempat'], true);
?>
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
        
        <div class="container mt-xl-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h6 class="text-primary">Detail</h6>
        <h1 class="mb-4"><?php echo htmlspecialchars($row['nama']); ?></h1>
    </div>
</div>

<div class="row g-0 bg-body-secondary position-relative">
    <div class="col-md-6 mb-md-0 p-md-4">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                if (is_array($fotoTempat)) {
                    $first = true;
                    foreach ($fotoTempat as $foto) {
                        $active = $first ? 'active' : '';
                ?>
                        <div class="carousel-item <?php echo $active; ?>">
                            <img src="../admin/<?php echo htmlspecialchars($foto); ?>" class="d-block w-100" style="object-fit: cover; height: 400px;" alt="Foto">
                        </div>
                <?php
                        $first = false;
                    }
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col-lg-6 about-text wow fadeIn" data-wow-delay="0.5s">
        <div class="pe-lg-0">
            <h6 class="text-primary">Informasi</h6>
            <h3 class="mb-4"><?php echo htmlspecialchars(substr($row['lokasi'], 0, 150)); ?><?php if (strlen($row['lokasi']) > 150) { echo "..."; } ?></h3>
            <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
            <div>
                <a href="<?php echo htmlspecialchars($row['linkMap']); ?>" class="btn btn-primary stretched-link" target="_blank">Jelajahi Lebih Lanjut</a>
            </div>
        </div>
    </div>
</div>

<?php
    } else {
        echo "<div class='col-md-12'><p class='text-center'>Data tidak ditemukan</p></div>";
    }
} else {
    echo "<div class='col-md-12'><p class='text-center'>ID tidak tersedia</p></div>";
}
?>
<?php include 'layout/footer.php'; ?>