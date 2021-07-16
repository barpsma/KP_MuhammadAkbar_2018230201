<?php
include 'koneksi.php';
?>
<fieldset>
            <legend>Laporan Data Servis</legend>
            <a href="cetak_laporan_servis.php" target="_blank">CETAK LAPORAN</a>
            <div style="margin-bottom:15px;" align="right">

            <form action="" method="post">
                    <input type="text" name="inputan_pencarian" placeholder="Masukan Nama Pelanggan" style="width:200px; padding:5px;" />
                    <input type="submit" name="cari_pelanggan" value="Cari" style="padding:3px;" />
            </form>
            </div>

            <table width="100%" border="1px" style="border-collapse:collapse;">
                <tr style="background-color:#355c7d; color:white;">
                    <th>Kode Servis</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Jasa</th>
                    <th>Biaya</th>
                </tr>
                <?php
                

                $inputan_pencarian = @$_POST['inputan_pencarian'];
                $cari_pelanggan = @$_POST['cari_pelanggan'];
                if($cari_pelanggan){
                    if($inputan_pencarian != ""){
                    $sql = mysqli_query($koneksi, "select * from tb_servis where nama_pelanggan like '%$inputan_pencarian%'") or die (mysqli_error($koneksi));
                    } else{
                        $sql = mysqli_query($koneksi, "select * from tb_servis") or die (mysqli_error($koneksi));
                    }
                } else {
                    $sql = mysqli_query($koneksi, "select * from tb_servis") or die (mysqli_error($koneksi));
                }

                $cek = mysqli_num_rows($sql);
                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="5" align="center" style="padding:10px;">Pelanggan Tidak ditemukan</td>
                    </tr>
                    <?php
                }else {

                while($data = mysqli_fetch_array($sql)){
                ?>
                    <tr>
                        <td><?php echo $data['kode_servis']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['nama_pelanggan']; ?></td>
                        <td><?php echo $data['jasa']; ?></td>
                        <td>Rp. <?php echo number_format($data['biaya']) ?></td>
                    </tr>
                <?php
                }
            }
                
                ?>
            </table>
</fieldset>