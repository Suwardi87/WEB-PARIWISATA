<?php
include 'layout/header.php';
include '../koneksi.php';

// Handle form submission for create and update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? '';
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $lokasi = $koneksi->real_escape_string($_POST['lokasi']);
    $deskripsi = $koneksi->real_escape_string($_POST['deskripsi']);
    $informasi = $koneksi->real_escape_string($_POST['informasi']);
    $linkMap = $koneksi->real_escape_string($_POST['linkMap']);

    // File upload handling
    $fotoTempat = [];
    if (isset($_FILES['fotoTempat']) && count($_FILES['fotoTempat']['error']) > 0) {
        for ($i = 0; $i < count($_FILES['fotoTempat']['name']); $i++) {
            if ($_FILES['fotoTempat']['error'][$i] == 0) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fotoTempat"]["name"][$i]);
                if (move_uploaded_file($_FILES["fotoTempat"]["tmp_name"][$i], $target_file)) {
                    $fotoTempat[] = $target_file;
                } else {
                    echo "Error uploading file.";
                }
            }
        }
        $fotoTempat = json_encode($fotoTempat); // Encode array of file paths to JSON string
    }

    if (isset($_POST['create'])) {
        // Create new place
        $stmt = $koneksi->prepare("INSERT INTO TempatWisata (nama, fotoTempat, lokasi, deskripsi, informasi, linkMap) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nama, $fotoTempat, $lokasi, $deskripsi, $informasi, $linkMap);
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        // Update existing place
        $update_sql = "UPDATE TempatWisata SET nama=?, lokasi=?, deskripsi=?, informasi=?, linkMap=?";
        if ($fotoTempat) {
            $update_sql .= ", fotoTempat=?";
        }
        $update_sql .= " WHERE idTempatWisata=?";
        $stmt = $koneksi->prepare($update_sql);
        if ($fotoTempat) {
            $stmt->bind_param("ssssssi", $nama, $lokasi, $deskripsi, $informasi, $linkMap, $fotoTempat, $id);
        } else {
            $stmt->bind_param("sssssi", $nama, $lokasi, $deskripsi, $informasi, $linkMap, $id);
        }
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $koneksi->prepare("DELETE FROM TempatWisata WHERE idTempatWisata=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

$sql = "SELECT * FROM TempatWisata";
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
                    <h3 class="fw-bold mb-3">Kelola Tempat Wisata</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Data Tempat Wisata</h4>
                                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#tempatWisataModal" onclick="resetForm()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Tempat Wisata
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="tempatWisataModal" tabindex="-1" aria-labelledby="tempatWisataModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tempatWisataModalLabel">Tambah Tempat Wisata</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="tempatWisataForm" method="POST" action="" enctype="multipart/form-data">
                                                    <input type="hidden" id="id" name="id">
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="fotoTempat" class="form-label">Foto Tempat</label>
                                                        <input type="file" class="form-control" id="fotoTempat" name="fotoTempat[]" multiple>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lokasi" class="form-label">Lokasi</label>
                                                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="informasi" class="form-label">Informasi</label>
                                                        <textarea class="form-control" id="informasi" name="informasi" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="linkMap" class="form-label">Link Map</label>
                                                        <input type="text" class="form-control" id="linkMap" name="linkMap" required>
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Foto Tempat</th>
                                                <th>Lokasi</th>
                                                <th>Deskripsi</th>
                                                <th>Informasi</th>
                                                <th>Link Map</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $fotoTempat = json_decode($row['fotoTempat'], true);
                                            ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                                        <td>
                                                            <?php
                                                            if (is_array($fotoTempat)) {
                                                                foreach ($fotoTempat as $foto) {
                                                                    echo '<img src="' . htmlspecialchars($foto) . '" width="50" class="zoom-out">';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($row['lokasi']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['informasi']); ?></td>
                                                        <td><a href="<?php echo htmlspecialchars($row['linkMap']); ?>" target="_blank">Link Map</a></td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tempatWisataModal" onclick="editTempatWisata(<?php echo htmlspecialchars(json_encode($row)); ?>)"><i class="fa fa-edit"></i></button>
                                                            <a href="?delete=<?php echo $row['idTempatWisata']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No records found</td></tr>";
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
    </div>
</div>

<script>
function resetForm() {
    document.getElementById('tempatWisataForm').reset();
    document.getElementById('id').value = '';
    document.getElementById('createBtn').classList.remove('d-none');
    document.getElementById('updateBtn').classList.add('d-none');
}

function editTempatWisata(data) {
    document.getElementById('id').value = data.idTempatWisata;
    document.getElementById('nama').value = data.nama;
    document.getElementById('lokasi').value = data.lokasi;
    document.getElementById('deskripsi').value = data.deskripsi;
    document.getElementById('informasi').value = data.informasi;
    document.getElementById('linkMap').value = data.linkMap;
    document.getElementById('createBtn').classList.add('d-none');
    document.getElementById('updateBtn').classList.remove('d-none');
}
</script>

<?php
include 'layout/footer.php';
?>
