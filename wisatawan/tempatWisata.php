<?php
include 'layout/header.php';
include '../koneksi.php';


$sql = "SELECT * FROM TempatWisata";
$result = $koneksi->query($sql);
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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="pencarian.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="query" placeholder="Cari..." aria-label="Search" aria-describedby="search-icon">
                    <button class="btn btn-success" type="submit" id="search-icon"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="container">
    <div class="page-inner">
        <div class="m-md-3">
            <h3>Objek Wisata</h3>
            <hr class="w-25">
        </div>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fotoTempat = json_decode($row['fotoTempat'], true);
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <div id="carouselExampleControls<?php echo $row['idTempatWisata']; ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    if (is_array($fotoTempat)) {
                                        $first = true;
                                        foreach ($fotoTempat as $index => $foto) {
                                            $active = $first ? 'active' : '';
                                            echo '<div class="carousel-item ' . $active . '">';
                                            echo '<img src="../admin/' . $foto . '" class="d-block w-100" alt="Foto">';
                                            echo '</div>';
                                            $first = false;
                                        }
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?php echo $row['idTempatWisata']; ?>" data-bs-slide="prev">

                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?php echo $row['idTempatWisata']; ?>" data-bs-slide="next">

                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                                <ul class="list-group list-group-flush text-ligth">
                                    <li class="list-group-item"><?php echo $row['lokasi']; ?></li>
                                </ul>
                                <a href="detailWisata.php?id=<?php echo $row['idTempatWisata']; ?>" class="btn btn-primary btn-lg d-block" style="text-decoration: none;">
                                    <i class="fa fa-info-circle"></i> Detail
                                </a>


                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-md-12'><p class='text-center'>Tidak ada data</p></div>";
            }
            ?>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>