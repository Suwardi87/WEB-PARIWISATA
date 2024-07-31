<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:admin/adminIndex.php");

	// cek jika user login sebagai wisatawan
	}else if($data['level']=="wisatawan"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "wisatawan";
		// alihkan ke halaman dashboard wisatawan
		header("location:wisatawan/wisatawanIndex.php");

	// cek jika user login sebagai staffPengelola
	}else if($data['level']=="staffPengelola"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "staffPengelola";
		// alihkan ke halaman dashboard staffPengelola
		header("location:admin/adminIndex.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}

	
}else{
	header("location:index.php?pesan=gagal");
}



?>