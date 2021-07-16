<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Data Iklan</legend>
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
            <th>Verifikasi</th>
            <th>Opsi</th>
        </tr>
        <?php
        $inputan_pencarian = @$_POST['inputan_pencarian'];
        $cari_iklan = @$_POST['cari_iklan'];
        if($cari_iklan){
            if($inputan_pencarian != ""){
            $sql = mysqli_query($koneksi, "select * from tb_mobil where nama_pengiklan='$_SESSION[nama]' and (merk like '%$inputan_pencarian%' or type like '%$inputan_pencarian%') order by status DESC") or die (mysqli_error($koneksi));
            } else{
                $sql = mysqli_query($koneksi, "select * from tb_mobil where nama_pengiklan='$_SESSION[nama]' order by status DESC") or die (mysqli_error($koneksi));
            }
        } else {
            $sql = mysqli_query($koneksi, "select * from tb_mobil where nama_pengiklan='$_SESSION[nama]' order by status DESC") or die (mysqli_error($koneksi));
        }

        $cek = mysqli_num_rows($sql);
        if($cek < 1){
            ?>
            <tr>
                <td colspan="11" align="center" style="padding:10px;">Mobil Tidak ditemukan</td>
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
                <td><?php echo $data['verifikasi']; ?></td>
                <td align="center">
                    <a href="?page=iklan&action=edit&kdmobil=<?php echo $data['kode_mobil']; ?>"><button>Edit</button></a>
                    <a onclick="return confirm('Yakin ingin menghapus iklan?')" href="?page=iklan&action=hapus&kdmobil=<?php echo $data['kode_mobil']; ?>"><button>Hapus</button></a>
                </td>
            </tr>
        <?php
        }
    }
        ?>
    </table>
</fieldset>