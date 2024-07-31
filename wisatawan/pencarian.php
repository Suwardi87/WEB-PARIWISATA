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

<?php
include '../koneksi.php';
// Get search query
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Insert the search query into the search history table
if (!empty($query)) {
    $stmt = $koneksi->prepare("INSERT INTO SearchHistory (query) VALUES (?)");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $stmt->close();
}

// Search the TempatWisata table
$sql = "SELECT * FROM TempatWisata WHERE nama LIKE ?";
$stmt = $koneksi->prepare($sql);
$search = "%" . $query . "%";
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="container mt-5">
    <h1>Hasil Pencarian untuk "<?php echo htmlspecialchars($query); ?>"</h1>
    <div class="row">
        <?php
        if ($query) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fotoTempat = json_decode($row['fotoTempat'], true);
                    echo "<div class='row g-0 bg-body-secondary position-relative mb-4'>";
                    echo "    <div class='col-md-6 mb-md-0 p-md-4'>";
                    echo "        <div id='carouselExampleControls-{$row['idTempatWisata']}' class='carousel slide' data-bs-ride='carousel'>";
                    echo "            <div class='carousel-inner'>";
                    
                    if (is_array($fotoTempat)) {
                        $first = true;
                        foreach ($fotoTempat as $foto) {
                            $active = $first ? 'active' : '';
                            echo "            <div class='carousel-item {$active}'>";
                            echo "                <img src='../admin/" . htmlspecialchars($foto) . "' class='d-block w-100' style='object-fit: cover; height: 400px;' alt='Foto'>";
                            echo "            </div>";
                            $first = false;
                        }
                    }

                    echo "            </div>";
                    echo "            <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleControls-{$row['idTempatWisata']}' data-bs-slide='prev'>";
                    echo "                <span class='carousel-control-prev-icon' aria-hidden='true'></span>";
                    echo "                <span class='visually-hidden'>Previous</span>";
                    echo "            </button>";
                    echo "            <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleControls-{$row['idTempatWisata']}' data-bs-slide='next'>";
                    echo "                <span class='carousel-control-next-icon' aria-hidden='true'></span>";
                    echo "                <span class='visually-hidden'>Next</span>";
                    echo "            </button>";
                    echo "        </div>";
                    echo "    </div>";
                    echo "    <div class='col-lg-6 about-text wow fadeIn' data-wow-delay='0.5s'>";
                    echo "        <div class='pe-lg-0'>";
                    echo "            <h6 class='text-primary'>Informasi</h6>";
                    echo "            <h3 class='mb-4'>" . htmlspecialchars(substr($row['nama'], 0, 150)) . (strlen($row['nama']) > 150 ? '...' : '') . "</h3>";
                    echo "            <p>" . htmlspecialchars($row['deskripsi']) . "</p>";
                    echo "            <div>";
                    echo "                <a href='" . htmlspecialchars($row['linkMap']) . "' class='btn btn-primary stretched-link' target='_blank'>Jelajahi Lebih Lanjut</a>";
                    echo "            </div>";
                    echo "        </div>";
                    echo "    </div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Tidak ada hasil yang ditemukan.</p>";
            }
        } else {
            echo "<p>Silakan masukkan kata kunci pencarian.</p>";
        }
        ?>
    </div>

    <h2 class="mt-5">Histori Pencarian</h2>
    <div class="row">
        <?php
        $sql_history = "SELECT * FROM SearchHistory ORDER BY search_date DESC LIMIT 10";
        $result_history = $koneksi->query($sql_history);

        if ($result_history->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr><th>Kata Kunci</th><th>Tanggal Pencarian</th></tr></thead>";
            echo "<tbody>";
            while ($row_history = $result_history->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row_history['query']) . "</td>";
                echo "<td>" . htmlspecialchars($row_history['search_date']) . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Tidak ada histori pencarian.</p>";
        }
        ?>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
