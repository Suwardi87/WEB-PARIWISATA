<div class="sidebar" data-background-color="dark">
	<div class="sidebar-logo">
		<!-- Logo Header -->
		<div class="logo-header" data-background-color="dark">
			<a href="../admin/adminIndex.php" class="logo">
				<h3 class="text-white">Wisata X KOTO</h3>
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
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<ul class="nav nav-secondary">
				<li class="nav-item active">
					<a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
						<i class="fas fa-home"></i>
						<p>Dashboard</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="dashboard">
						<ul class="nav nav-collapse">
							<li>
								<a href="../admin/adminIndex.php">
									<span class="sub-item">Dashboard</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="nav-item active">
					<a data-bs-toggle="collapse" href="#Akun" class="collapsed" aria-expanded="false">
						<i class="fas fa-user"></i>
						<p>Data Akun</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="Akun">
						<ul class="nav nav-collapse">
							<li>
								<a href="../admin/kelolaAkun.php">
									<span class="sub-item">Kelola Akun</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="nav-item active">
					<a data-bs-toggle="collapse" href="#Data" class="collapsed" aria-expanded="false">
						<i class="fas fa-database"></i>
						<p>Data</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="Data">
						<ul class="nav nav-collapse">
							<li>
								<!-- <a href="../admin/staff_pengelola.php">
									<span class="sub-item">Data Staff Pengelola</span>
								</a> -->
								<a href="../admin/wisatawan.php">
									<span class="sub-item">Data Wisatawan</span>
								</a>
								<a href="../admin/tempat_wisata.php">
									<span class="sub-item">Data Tempat Wisata</span>
								</a>
								<a href="../admin/ulasan.php">
									<span class="sub-item">Data Ulasan</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>