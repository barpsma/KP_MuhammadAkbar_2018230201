<?php 

session_start();


if (!isset($_SESSION["username"])) {
	echo "Anda harus login dahulu <br><a href='login.php'>Klik disini</a>";
	exit;
}

$level=$_SESSION["level"];


if ($level!='admin') {
    echo "Anda tidak punya akses pada halaman Admin";
    exit;
}
?>


<?php
include 'koneksi.php';
$sql = mysqli_query($koneksi, "select * from user where username='$_SESSION[username]'") or die (mysqli_error($koneksi));
$data = mysqli_fetch_array($sql)
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style type="text/css">
    body{
        font-family: arial;
        font-size: 14px;
    }

    #canvas{
        width: auto;
        margin: 0 auto;
        border: 3px solid silver;
    }

    #header{
        padding: 20px;
        font-size: 45px;
        font-weight: 800;
        font-family: Verdana;
        color: #e23e57;
    }

    #menu{
        background-color: #355c7d;
    }

    #menu ul{
        list-style: none;
        margin: 0;
        padding: 0;
    }

    #menu ul li.utama{
        display: inline-table;
    }

    #menu ul li.logouttombol{
        display: inline-table;
        background-color : #e23e57;
    }

    #menu ul li.logouttombol:hover{
        background-color : steelblue;
    }

    #menu ul li:hover{
        background-color: steelblue;
    }

    #menu ul li a{
        display: block;
        text-decoration: none;
        line-height: 40px;
        padding: 0 10px;
        color: white;
    }

    .utama ul{
        display: none;
        position: absolute;
        z-index: 2;
    }

    .utama:hover ul{
        display: block;
    }

    .utama ul li{
        display: block;
        background-color: #e23e57;
        width: 140px;
    }

    #isi{
        min-height: 400px;
        padding: 20px;
    }

    #footer{
        text-align: center;
        padding: 20px;
        background-color: silver;
    }




    </style>
</head>
<body>

    <div id="canvas">
    <div id="header">
            Ananda Motor
        </div>

        <div id="menu">
            <ul>
                <li class="utama"><a href="?page=">Beranda</a></li>
                <li class="utama"><a href="?page=user_manajemen">User Manajemen</a>
                    <ul>
                        <li><a href="?page=user_manajemen&action=tambah">Tambah User</a></li>
                    </ul>
                </li>
                <li class="utama"><a href="?page=iklan_manajemen">Iklan Manajemen</a></li>
                <li class="utama"><a href="?page=biaya_dashboard">Biaya</a>
                    <ul>
                        <li><a href="?page=biaya">Lihat Biaya</a></li>
                        <li><a href="?page=biaya&action=tambah">Tambah Biaya</a></li>
                    </ul>
                </li>
                <li class="utama"><a href="?page=data_servis">Laporan Data Servis</a>
                    <ul>
                        <li><a href="?page=data_servis&action=tambah">Tambah Data</a></li>
                    </ul>
                </li>
                <li class="utama"><a href="?page=data_mobil_terjual">Mobil Terjual</a></li>
                
                
                <li class="logouttombol" style="float:right;"><a href="logout.php">Logout</a></li>
                <li class="utama" style="float:right;"><a href="?page=edit&action=edit&iduser=<?php echo $data['id']; ?>">Selamat Datang, <?php echo $_SESSION['nama']; ?></a></li>
            </ul>
        </div>


        <div id="isi">
            <?php
            $page   = @$_GET['page'];
            $action = @$_GET['action'];
            if($page == "user_manajemen") {
                if($action == "") {
                    include "user_manajemen.php";
                } else if($action == "hapus"){
                    include "hapus_user.php";
                } else if($action == "tambah"){
                    include "tambah_user.php";
                } else {
                    echo "Halaman tidak ditemukan!!!";
                }
            }
                else if($page == "data_servis") {
                    if($action == "") {
                        include "laporan_data_servis.php";
                    } else if($action == "tambah"){
                        include "data_servis.php";
                    } else {
                        echo "Halaman tidak ditemukan!!!";
                    }
                }
                else if($page == "iklan_manajemen") {
                    if($action == "") {
                        include "iklan_manajemen.php";
                    } else if($action == "hapus"){
                        include "hapus_iklan.php";
                    } else if($action == "terjual"){
                        include "mobil_terjual.php";
                    } else if($action == "verifikasi"){
                        include "verifikasi_mobil.php";
                    } else {
                        echo "Halaman tidak ditemukan!!!";
                    }
                }
                else if($page == "data_mobil_terjual") {
                    if($action == "") {
                        include "data_mobil_terjual.php";
                    } else if($action == "hapus"){
                        include "data_mobil_terjual_hapus.php";
                    } else {
                        echo "Halaman tidak ditemukan!!!";
                    }
                }
                else if($page == "edit") {
                    if($action == "edit") {
                        include "edit_data_user.php";
                    } else {
                        echo "edit_data_user.php";
                    }
                }
                else if($page == "biaya") {
                    if($action == "") {
                        include "lihat_biaya.php";
                    } else if($action == "tambah"){
                        include "tambah_biaya.php";
                    } else if($action == "edit"){
                        include "edit_biaya.php";
                    } else if($action == "hapus"){
                        include "hapus_biaya.php";
                    } else {
                        echo "Halaman tidak ditemukan!!!";
                    }
                }
                else if($page == "") {
                    include "beranda_admin.php";
                } else if($page == "user_manajemen") {
                    echo "Selamat Datang di halaman Admin";
                } else if($page == "biaya_dashboard") {
                    echo "Silahkan Atur Biaya";
                } else {
                    echo "Halaman tidak ditemukan!!!";
                }
             ?>
        </div>

        <div id="footer">
            Copyright 2021 Ananda Motor
        </div>
    </div>
</body>
</html>