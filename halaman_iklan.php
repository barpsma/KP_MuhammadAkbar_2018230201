<?php
include 'koneksi.php';
// start a session
session_start();
$_SESSION['verifikasi'] = "setujui";

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Iklan</title>
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

    #menu ul li.login{
        display: inline-table;
        background-color : #e23e57;
    }

    #menu ul li.login:hover{
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
                <li class="utama"><a href="index.html">Kembali</a></li>
                <li class="login" style="float:right;"><a href="login.php">Login</a></li>
            </ul>
        </div>

        <div id="isi">
        <?php
        include 'koneksi.php';
        ?>

        <fieldset>
            <legend>Iklan Mobil</legend>

            <div style="margin-bottom:15px;" align="right">

            <form action="" method="post">
                    <input type="text" name="inputan_pencarian" placeholder="Masukan Nama Mobil" style="width:200px; padding:5px;" />
                    <input type="submit" name="cari_iklan" value="Cari" style="padding:3px;" />
            </form>
            </div>

            <table width="100%" border="1px" style="border-collapse:collapse;">
                <tr style="background-color:#355c7d; color:white;">
                    <th>Kode Mobil</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Warna</th>
                    <th>Harga</th>
                    <th>Nama Pengiklan</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Gambar</th>
                </tr>
                <?php
                $inputan_pencarian = @$_POST['inputan_pencarian'];
                $cari_iklan = @$_POST['cari_iklan'];
                if($cari_iklan){
                    if($inputan_pencarian != ""){
                    $sql = mysqli_query($koneksi, "select * from tb_mobil where verifikasi='$_SESSION[verifikasi]' and (merk like '%$inputan_pencarian%' or type like '%$inputan_pencarian%') order by status DESC") or die (mysqli_error($koneksi));
                    } else{
                        $sql = mysqli_query($koneksi, "select * from tb_mobil where verifikasi='$_SESSION[verifikasi]' order by status DESC") or die (mysqli_error($koneksi));
                    }
                } else {
                    $sql = mysqli_query($koneksi, "select * from tb_mobil where verifikasi='$_SESSION[verifikasi]' order by status DESC") or die (mysqli_error($koneksi));
                }

                $cek = mysqli_num_rows($sql);
                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="9" align="center" style="padding:10px;">Mobil Tidak ditemukan</td>
                    </tr>
                    <?php
                }else {

                while($data = mysqli_fetch_array($sql)){
                ?>
                
                    <tr>
                        <td><?php echo $data['kode_mobil']; ?></td>
                        <td><?php echo $data['merk']; ?></td>
                        <td><?php echo $data['type']; ?></td>
                        <td><?php echo $data['warna']; ?></td>
                        <td>Rp. <?php echo number_format($data['harga']) ?></td>
                        <td><?php echo $data['nama_pengiklan']; ?></td>
                        <td><?php echo $data['no_hp']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td align="center"><img src="iklan/<?php echo $data['gambar']; ?>" width="120px"/></td>
                    </tr>
                <?php
                }
            }
                ?>
            </table>
        </fieldset>
        </div>

        <div id="footer">
            Copyright 2021 Ananda Motor
        </div>
    </div>
</body>
</html>