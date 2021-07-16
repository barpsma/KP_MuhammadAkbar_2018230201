<?php 
    include "koneksi.php";
    $nama = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = ("pengunjung");
    $cek_user=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM user where username='$username'"));
    if ($cek_user > 0) {
              header("location:register.php?pesan=Username sudah digunakan!");
    }
    else {
        mysqli_query($koneksi,"insert into user (nama,username,password,level) values
        ('$nama','$username','$password','$level')");
              header("location:login.php?pesan= Register Berhasil, Silahkan Login.");
    }
?>