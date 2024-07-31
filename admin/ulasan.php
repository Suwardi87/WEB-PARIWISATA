<?php
include 'layout/header.php';
include '../koneksi.php';

// Fetch data for dropdowns
$wisatawanResult = $koneksi->query("SELECT idWisatawan, nama FROM wisatawan");
$tempatWisataResult = $koneksi->query("SELECT idTempatWisata, nama FROM tempatWisata");


// Handle form submission for create and update
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
            // Add new notification
            $notifContent = "New review added";
            $koneksi->query("INSERT INTO notifications (content) VALUES ('$notifContent')");
            $notifCount++; // Increment notification count
            echo "<script>updateNotificationCount($notifCount);</script>";
            echo "<script>addNewNotification('$notifContent', 'just now');</script>";
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

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM Ulasan WHERE idUlasan=$id";
    if ($koneksi->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $koneksi->error;
    }
}

// Query to fetch review data with joined tables
$sql = "
    SELECT Ulasan.idUlasan, wisatawan.nama AS wisatawanNama, tempatWisata.nama AS tempatWisataNama, Ulasan.rating, Ulasan.komentar 
    FROM Ulasan 
    INNER JOIN wisatawan ON Ulasan.idWisatawan = wisatawan.idWisatawan 
    INNER JOIN tempatWisata ON Ulasan.idTempatWisata = tempatWisata.idTempatWisata
";
$result = $koneksi->query($sql);
?>

<div class="wrapper">
    <!-- Sidebar -->
    <?php include 'layout/sidebar.php'; ?>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <!-- Navbar Header -->
            <?php include 'layout/navbar.php'; ?>
            <!-- End Navbar -->
        </div>

        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Kelola Ulasan</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Data Ulasan</h4>
                                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#ulasanModal" onclick="resetForm()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Ulasan
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="ulasanModal" tabindex="-1" aria-labelledby="ulasanModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ulasanModalLabel">Tambah Ulasan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="ulasanForm" method="POST" action="">
                                                    <input type="hidden" id="id" name="id">
                                                    <div class="mb-3">
                                                        <label for="idWisatawan" class="form-label">Wisatawan</label>
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
                                                        <label for="idTempatWisata" class="form-label">Tempat Wisata</label>
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
                                                        <input type="number" class="form-control" id="rating" name="rating" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="komentar" class="form-label">Komentar</label>
                                                        <textarea class="form-control" id="komentar" name="komentar" required></textarea>
                                                    </div>
                                                    <button type="submit" name="create" id="createBtn" class="btn btn-primary">Tambah</button>
                                                    <button type="submit" name="update" id="updateBtn" class="btn btn-primary d-none">Update</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Wisatawan</th>
                                                <th>Tempat Wisata</th>
                                                <th>Rating</th>
                                                <th>Komentar</th>
                                                <th style="width: 10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['idUlasan']; ?></td>
                                                        <td><?php echo $row['wisatawanNama']; ?></td>
                                                        <td><?php echo $row['tempatWisataNama']; ?></td>
                                                        <td><?php echo $row['rating']; ?></td>
                                                        <td><?php echo $row['komentar']; ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <button type="button" class="btn btn-link btn-primary btn-lg" onclick="editUlasan(<?php echo $row['idUlasan']; ?>, '<?php echo $row['wisatawanNama']; ?>', '<?php echo $row['tempatWisataNama']; ?>', '<?php echo $row['rating']; ?>', '<?php echo $row['komentar']; ?>')">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <a href="?delete=<?php echo $row['idUlasan']; ?>" class="btn btn-link btn-danger">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'layout/footer.php'; ?>

        <script>
            function resetForm() {
                document.getElementById('ulasanForm').reset();
                document.getElementById('ulasanModalLabel').textContent = 'Tambah Ulasan';
                document.getElementById('createBtn').classList.remove('d-none');
                document.getElementById('updateBtn').classList.add('d-none');
            }

            function editUlasan(id, idWisatawan, idTempatWisata, rating, komentar) {
                document.getElementById('id').value = id;
                document.getElementById('idWisatawan').value = idWisatawan;
                document.getElementById('idTempatWisata').value = idTempatWisata;
                document.getElementById('rating').value = rating;
                document.getElementById('komentar').value = komentar;
                document.getElementById('ulasanModalLabel').textContent = 'Edit Ulasan';
                document.getElementById('createBtn').classList.add('d-none');
                document.getElementById('updateBtn').classList.remove('d-none');
                var myModal = new bootstrap.Modal(document.getElementById('ulasanModal'), {});
                myModal.show();
            }
        </script>
    </div>
</div>
