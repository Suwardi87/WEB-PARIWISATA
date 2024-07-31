<?php
include 'layout/header.php';
include '../koneksi.php';

// Query total wisatawan
$totalWisatawanResult = $koneksi->query("SELECT COUNT(idWisatawan) AS totalWisatawan FROM wisatawan");
if ($totalWisatawanResult) {
    $row = $totalWisatawanResult->fetch_assoc();
    $totalWisatawan = $row['totalWisatawan'];
} else {
    $totalWisatawan = "Error fetching data: " . $koneksi->error;
}

// Query total pengguna (users)
$totalUserResult = $koneksi->query("SELECT COUNT(id) AS totalUser FROM user");
if ($totalUserResult) {
    $row = $totalUserResult->fetch_assoc();
    $totalUser = $row['totalUser'];
} else {
    $totalUser = "Error fetching data: " . $koneksi->error;
}

// Query total tempat wisata
$totalTempatWisataResult = $koneksi->query("SELECT COUNT(idTempatWisata) AS totalTempatWisata FROM tempatWisata");
if ($totalTempatWisataResult) {
    $row = $totalTempatWisataResult->fetch_assoc();
    $totalTempatWisata = $row['totalTempatWisata'];
} else {
    $totalTempatWisata = "Error fetching data: " . $koneksi->error;
}
?>

<div class="wrapper">
  <!-- Sidebar -->
  <?php
  include 'layout/sidebar.php';
  ?>
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
      <?php
      include 'layout/navbar.php';
      ?>
      <!-- End Navbar -->
    </div>

    <div class="container">
      <div class="page-inner">
        <div class="page-header">
          <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-icon">
                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                  <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                      <p class="card-category">Users</p>
                      <h4 class="card-title"><?= $totalUser; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-icon">
                    <div class="icon-big text-center icon-info bubble-shadow-small">
                      <i class="fas fa-user-check"></i>
                    </div>
                  </div>
                  <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                      <p class="card-category">Destinasi</p>
                      <h4 class="card-title"><?= $totalTempatWisata; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-icon">
                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                      <i class="far fa-check-circle"></i>
                    </div>
                  </div>
                  <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                      <p class="card-category">Wisatawan</p>
                      <h4 class="card-title"><?= $totalWisatawan; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Our Location</div>
              </div>
              <div class="card-body">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127020.6738326943!2d100.3029675!3d-0.4745618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd524fa8b2e761f%3A0x4039d80b2210fc0!2sKec.+Sepuluh+Koto%2C+Kabupaten+Tanah+Datar%2C+Sumatera+Barat!5e0!3m2!1sid!2sid!4v1701054428265!5m2!1sid!2sid" width="600" height="450" style="border: 0; width: 100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  include 'layout/footer.php';
  ?>