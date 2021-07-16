<?php

$koneksi        = mysqli_connect("localhost", "root", "", "ananda_motor");


$nissan       = mysqli_query($koneksi, "SELECT merk FROM tb_mobil_terjual WHERE merk = 'Nissan' ");


$toyota      = mysqli_query($koneksi, "SELECT merk FROM tb_mobil_terjual WHERE merk = 'Toyota' ");
?>

<html>
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>

<fieldset>
    <legend>Data Mobil Terjual</legend>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <canvas id="myChart" ></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                // tipe chart
                type: 'bar',
                data: {

                    //karena hanya menggunakan 2 batang
                    //maka buat dua lebel, yaitu lebel laki-laki dan perempuan
                    labels: ['Nissan', 'Toyota'],

                    //dataset adalah data yang akan ditampilkan
                    datasets: [{
                            label: 'jumlah mobil',

                            //karena hanya menggunakan 2 batang/bar
                            //maka 2 sql yang dibutuhkan
                            //hitung jumlah merk nissan dan dan merk toyota
                            data: [
                                <?php echo mysqli_num_rows($nissan); ?>,
                                <?php echo mysqli_num_rows($toyota);?>,
                            ],

                            //atur background barchartnya
                            //karena cuma dua, maka 2 saja yang diatur
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)'
                            ],

                            //atur border barchartnya
                            //karena cuma dua, maka 2 saja yang diatur
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>

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
            <th>Opsi</th>
        </tr>
        <?php
        $inputan_pencarian = @$_POST['inputan_pencarian'];
        $cari_iklan = @$_POST['cari_iklan'];
        if($cari_iklan){
            if($inputan_pencarian != ""){
            $sql = mysqli_query($koneksi, "select * from tb_mobil_terjual where merk like '%$inputan_pencarian%' or type like '%$inputan_pencarian%'") or die (mysqli_error($koneksi));
            } else{
                $sql = mysqli_query($koneksi, "select * from tb_mobil_terjual") or die (mysqli_error($koneksi));
            }
        } else {
            $sql = mysqli_query($koneksi, "select * from tb_mobil_terjual") or die (mysqli_error($koneksi));
        }

        $cek = mysqli_num_rows($sql);
        if($cek < 1){
            ?>
            <tr>
                <td colspan="10" align="center" style="padding:10px;">Mobil Tidak ditemukan</td>
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
                <td align="center">
                    <a onclick="return confirm('Yakin ingin menghapus iklan?')" href="?page=data_mobil_terjual&action=hapus&kdmobil=<?php echo $data['kode_mobil']; ?>"><button>Hapus</button></a>
                </td>
            </tr>
        <?php
        }
    }
        ?>
    </table>
</fieldset>