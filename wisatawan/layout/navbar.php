<!-- Navbar Brand -->
<a href="wisatawanIndex.php" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
    <h2 class="m-0 text-success">Wisata X KOTO</h2>
</a>

<!-- Toggle Button -->
<button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- Navbar Collapse -->
<div class="collapse navbar-collapse mx-3" id="navbarCollapse">
    <div class="navbar-nav ms-auto p-4 mx-3 p-lg-0">
        <!-- Navigasi Link -->
        <a href="wisatawanIndex.php" class="nav-item nav-link active" aria-current="page">Beranda</a>
        <a href="tempatWisata.php" class="nav-item nav-link">Tempat Wisata </a>
        <!-- <a href="reservasi.php" class="nav-item nav-link">Reservasi</a> -->
        <a href="tentangKami.php" class="nav-item nav-link">Tentang Kami</a>

        <!-- Link Kontak -->
        <a href="kontak.php" class="nav-item nav-link">Ulasan</a>
    </div>
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $_SESSION['username']; ?></a>
        <div class="dropdown-menu bg-light m-0">
            <a href="../logout.php" class="dropdown-item">Logout</a>
        </div>
    </div>
</div>