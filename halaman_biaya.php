<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Biaya</title>
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
            <legend>Biaya Jasa</legend>

            <div style="margin-bottom:15px;" align="right">

            <form action="" method="post">
                    <input type="text" name="inputan_pencarian" placeholder="Masukan Nama Jasa" style="width:200px; padding:5px;" />
                    <input type="submit" name="cari_biaya" value="Cari" style="padding:3px;" />
            </form>
            </div>

            <table width="100%" border="1px" style="border-collapse:collapse;">
                <tr style="background-color:#355c7d; color:white;">
                    <th>Kode Biaya</th>
                    <th>Nama Jasa</th>
                    <th>Perkiraan Waktu</th>
                    <th>Perkiraan Harga</th>
                </tr>
                <?php
                $inputan_pencarian = @$_POST['inputan_pencarian'];
                $cari_biaya = @$_POST['cari_biaya'];
                if($cari_biaya){
                    if($inputan_pencarian != ""){
                    $sql = mysqli_query($koneksi, "select * from tb_biaya where nama_jasa like '%$inputan_pencarian%' or kode_biaya like '%$inputan_pencarian%'") or die (mysqli_error($koneksi));
                    } else{
                        $sql = mysqli_query($koneksi, "select * from tb_biaya") or die (mysqli_error($koneksi));
                    }
                } else {
                    $sql = mysqli_query($koneksi, "select * from tb_biaya") or die (mysqli_error($koneksi));
                }

                $cek = mysqli_num_rows($sql);
                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="4" align="center" style="padding:10px;">Jasa Tidak ditemukan</td>
                    </tr>
                    <?php
                }else {

                while($data = mysqli_fetch_array($sql)){
                ?>
                    <tr>
                        <td><?php echo $data['kode_biaya']; ?></td>
                        <td><?php echo $data['nama_jasa']; ?></td>
                        <td><?php echo $data['perkiraan_waktu']; ?></td>
                        <td>Rp. <?php echo number_format($data['harga']) ?></td>
                    </tr>
                <?php
                }
            }
                ?>
            </table>
        </fieldset>
        <p>Ket :</p>
        <p>- Harga jasa dapat berubah sewaktu – waktu tanpa pemberitahuan terlebih dahulu.</p>
        <p>- Menyesuaikan tahun kendaraan dan tingkat kesulitan pekerjaan perbaikan.</p>
        </div>

        <div id="footer">
            Copyright 2021 Ananda Motor
        </div>
    </div>
</body>
</html>