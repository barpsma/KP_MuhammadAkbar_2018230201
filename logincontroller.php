<?php 
session_start();
include 'koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];
$result = mysqli_query($koneksi,"SELECT * FROM user where username='$username' and password='$password'");
$cek = mysqli_num_rows($result);
if($cek > 0) {
	$data = mysqli_fetch_assoc($result);
    if($data['level']=="admin"){
		$_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
	    $_SESSION['status'] = "sudah_login";
	    $_SESSION['id_login'] = $data['id'];
		$_SESSION['level'] = "admin";
		header("location:home_admin.php");
	} else if($data['level']=="pengunjung"){
		$_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
	    $_SESSION['status'] = "sudah_login";
	    $_SESSION['id_login'] = $data['id'];
		$_SESSION['level'] = "pengunjung";
		header("location:home_pengunjung.php");
	}
} else {
	header("location:login.php?pesan=login gagal! user tidak ditemukan.");
}
?>