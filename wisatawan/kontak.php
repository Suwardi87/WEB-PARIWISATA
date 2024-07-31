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
<!-- Contact Start -->
<div class="container-fluid bg-light overflow-hidden py-5 px-lg-0">
    <div class="container contact py-lg-5">
        <div class="text-center mb-5">
            <h6 class="text-primary">Kontak</h6>
            <h1 class="mb-4">Kontak Kami</h1>
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
                    <div class="mb-3">
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


<?php include 'layout/footer.php'; ?>