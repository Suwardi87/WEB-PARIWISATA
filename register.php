<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? '';
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash the password
    $level = $_POST['level'];

    if (isset($_POST['create'])) {
        // Create new user in 'user' table
        $sql_user = "INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$username', '$password', '$level')";

        if ($koneksi->query($sql_user) === TRUE) {
            if ($level == 'wisatawan') {
                // Create new wisatawan
                $sql = "INSERT INTO wisatawan (nama, username, password) VALUES ('$nama', '$username', '$password')";
            } elseif ($level == 'staff') {
                // Create new staffPengelola
                $sql = "INSERT INTO staffPengelola (nama, username, password) VALUES ('$nama', '$username', '$password')";
            }

            if (isset($sql) && $koneksi->query($sql) === TRUE) {
                // Redirect to index.php
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        } else {
            echo "Error: " . $sql_user . "<br>" . $koneksi->error;
        }
    } 
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Web - Pariwisata</title>
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('wisatawan/assets/img/bg.jpg');
            /* Ganti URL gambar dengan URL gambar pemandangan yang Anda inginkan */
            background-size: cover;
            background-position: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Konten lainnya tetap sama seperti yang Anda berikan -->

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-lg-6">
                <div class="login-container">
                    <h3 class="text-center mb-4">Silahkan Login</h3>
                    <form id="userForm" method="POST" action="">
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-none mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-control" id="level" name="level" required>
                                <option value="wisatawan">Wisatawan</option>
                                <!-- <option value="staff">Staff</option>
                                <option value="admin">Admin</option> -->
                            </select>
                        </div>
                        <button type="submit" name="create" id="createBtn" class="btn form-control mb-3 btn-primary">Daftar</button>
                        <div class="mb-3 text-center">
                            <a href="register.php" class="text-center">Sudah memiliki akun? Masuk sekarang!</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>